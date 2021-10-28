function initAutocomplete() {
    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 34.97235, lng: 138.38889 },
        zoom: 13,
        mapTypeId: "roadmap",
    });
    // Create the search box and link it to the UI element.
    const input = document.getElementById("pac-input");
    const searchBox = new google.maps.places.SearchBox(input);
    var address = document.getElementById("address").textContent;
    var name = document.getElementById("name").textContent;
    var geocoder;
    var marker;
    var infoWindow;
  
    geocoder = new google.maps.Geocoder(); // ジオコードの準備
    geocoder.geocode({ // ジオコードのリクエスト
        'address': address // 調べる住所
    }, 
    function(results, status) { // ジオコードのリクエスト結果
        if (status === google.maps.GeocoderStatus.OK) {
            marker = new google.maps.Marker({
                position: results[0].geometry.location,
                map: map
            });
        } else {
            alert('Error: ' + status);
        }
        infoWindow = new google.maps.InfoWindow({ // 吹き出しの追加
            content: name // 吹き出しに表示する内容
        });
        marker.addListener('click', function() { // マーカーをクリックしたとき
            infoWindow.open(map, marker); // 吹き出しの表示
        });
    });

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
}