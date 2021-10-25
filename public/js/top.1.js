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
  
  
  var markerD = [];

      // DB情報の取得(ajax)
      $(function(){
        $.ajax({
          type: "GET",
          url: "/maps",
          dataType: "json",
          success: function(data){
            markerD = data;
            console.log(markerD);
            setMarker(markerD);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown){
            alert('Error : ' + errorThrown);
          }
        });
      });
  
  // 現在表示されているinfoWindowオブジェクト
  
  
  var marker = [];
var infoWindow = [];
  
  function setMarker(markerData) {

        //マーカー生成
        var icon;

        for (var i = 0; i < markerData.length; i++) {

          var latNum = parseFloat(markerData[i]['lat']);
          var lngNum = parseFloat(markerData[i]['lng']);

  // マーカー位置セット
        var markerLatLng = new google.maps.LatLng({
            lat: latNum,
            lng: lngNum
          });
          
  // マーカーのセット
          marker[i] = new google.maps.Marker({
            position: markerLatLng,          // マーカーを立てる位置を指定
            map: map,                        // マーカーを立てる地図を指定
            icon: icon                       // アイコン指定
          });
          
    // 吹き出しの追加
          infoWindow[i] = new google.maps.InfoWindow({
              name : markerData[i]['name'],
            content: "<a href='/maps/" + markerData[i]['name'] + "'>" + markerData[i]['name'] + '</a>' + '<br><br>' + markerData[i]['address'] 
          });
          
          
          markerEvent(i);
        }
        
        var openWindow;

      function markerEvent(i) {
        marker[i].addListener('click', function() {
          myclick(i);
        });
      }

      function myclick(i) {
        if(openWindow){
          openWindow.close();
        }
        infoWindow[i].open(map, marker[i]);
        openWindow = infoWindow[i];
      }
         
    
  };
};

