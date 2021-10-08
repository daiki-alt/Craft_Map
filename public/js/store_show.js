// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
function initAutocomplete() {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 34.97235, lng: 138.38889 },
    zoom: 13,
    mapTypeId: "roadmap",
  });
  // Create the search box and link it to the UI element.
  const input = document.getElementById("pac-input");
  const searchBox = new google.maps.places.SearchBox(input);

  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  // Bias the SearchBox results towards current map's viewport.
  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });

  let markers = [];

  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach((marker) => {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();

    places.forEach((place) => {
      if (!place.geometry || !place.geometry.location) {
        console.log("Returned place contains no geometry");
        return;
      }

      const icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25),
      };

      // Create a marker for each place.
      markers.push(
        new google.maps.Marker({
          map,
          icon,
          title: place.name,
          position: place.geometry.location,
        })
      );
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
  
  //マーカーのデータ
  const data = [
    { name: "駿河の工房　匠宿", lat: 34.95361760276212, lng: 138.33336521292009 },
    { name: "金剛石目塗鳥羽漆芸", lat: 34.96667419951148, lng: 138.39463709942694 },
  ];
  
  // 現在表示されているinfoWindowオブジェクト
  let currentWindow;
  
  data.map(d => {
    // マーカーをつける
    const marker = new google.maps.Marker({
      position: {lat: d.lat, lng: d.lng},
      map: map,
      // title: data[name]
    });
    
    // マーカークリックしたら地名をポップアップさせる
    marker.addListener('click', (e) => {
      currentWindow && currentWindow.close();
      const infoWindow = new google.maps.InfoWindow({content: `<a href="/maps/${ d.name }"><h2 classs="title">${ d.name }</h2></a>`});
      infoWindow.open(map, marker);
      currentWindow = infoWindow;
    });
  });

}
