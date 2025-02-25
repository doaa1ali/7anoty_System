document.querySelector('.menu-toggle label').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('closed');
    document.querySelector('.main-content').classList.toggle('shift-left');
});



// setTimeout(function() {
//     document.querySelector('.alert').style.display = 'none';
// }, 3000);


document.addEventListener("DOMContentLoaded", function () {
    let links = document.querySelectorAll(".header-nav a");
    let currentPath = window.location.pathname;

    links.forEach(link => {
        if (link.getAttribute("href") === currentPath) {
            link.classList.add("active");
        }

        link.addEventListener("click", function () {
            links.forEach(item => item.classList.remove("active"));
            this.classList.add("active");
        });
    });
});



// function toggleServiceForm() {
//     var formContainer = document.getElementById("serviceFormContainer");
//     formContainer.style.display = (formContainer.style.display === "none" || formContainer.style.display === "") ? "block" : "none";
// }



//
// function searchInMap() {

//     let searchQuery = document.getElementById('mapSearch').value;
//     console.log(searchQuery);
//     if (searchQuery) {
//         let googleSearchUrl = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(searchQuery)}`;
//         window.open(googleSearchUrl, '_blank'); // فتح البحث في نافذة جديدة
//     }
// }

// function updateMap(lat, long) {
//     let mapFrame = document.getElementById('mapFrame');
//     let newSrc = `https://www.google.com/maps?q=${lat},${long}&z=15&output=embed`;
//     mapFrame.src = newSrc;

//     document.getElementById('lat').value = lat;
//     document.getElementById('long').value = long;
// }

// document.getElementById('mapFrame').addEventListener('click', function () {
//     console.log('tess');
//     let lat = 30.0444 + (Math.random() * 0.01); // محاكاة اختيار موقع
//     let long = 31.2357 + (Math.random() * 0.01);
//     updateMap(lat, long);
// });


let lat = 30.0444; // Cairo, Egypt
let lng = 31.2357; // Cairo, Egypt
const isEditPage = false;
const isShowPage = false;



var geocoder;
var googleMap;
var marker;
var autocomplete;

function myMap() {
    var myLatlng = { lat: lat, lng: lng };

    var mapProp = {
        center: myLatlng,
        zoom: 12,
    };

    googleMap = new google.maps.Map(
        document.getElementById("googleMap"),
        mapProp
    );

    marker = new google.maps.Marker({
        position: mapProp.center,
        map: googleMap,
        animation: google.maps.Animation.DROP,
        draggable: true,
    });

    geocoder = new google.maps.Geocoder();

    // Initialize Google Places Autocomplete
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById("location_inp")
    );
    autocomplete.addListener("place_changed", function () {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            console.log("No details available for input: '" + place.name + "'");
            return;
        }

        // Move marker & update map
        googleMap.setCenter(place.geometry.location);
        googleMap.setZoom(14);
        marker.setPosition(place.geometry.location);

        // Update lat/lng hidden fields
        document.getElementById("lat_inp").value =
            place.geometry.location.lat();
        document.getElementById("lng_inp").value =
            place.geometry.location.lng();
    });

    // Click event to update marker & get address
    googleMap.addListener("click", function (mapsMouseEvent) {
        let clickLocation = mapsMouseEvent.latLng;
        marker.setPosition(clickLocation);

        geocoder.geocode(
            { location: clickLocation },
            function (results, status) {
                if (status === "OK" && results[0]) {
                   // document.getElementById("location_inp").value = results[0].formatted_address;
                    document.getElementById("lat_inp").value = clickLocation.lat();
                    document.getElementById("lng_inp").value = clickLocation.lng();
                    
                } else {
                    console.log("Geocode error: " + status);
                }
            }
            
        );
    });
    
    // Drag marker to update address
    marker.addListener("dragend", function () {
        var position = marker.getPosition();
        geocoder.geocode({ location: position }, function (results, status) {
            if (status === "OK" && results[0]) {
                document.getElementById("location_inp").value =
                    results[0].formatted_address;
                document.getElementById("lat_inp").value = position.lat();
                document.getElementById("lng_inp").value = position.lng();
                console.log(position.lat())
            }
        });
    });
}

// Get current location
function getCurrentPos() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
            };
            marker.setPosition(pos);
            googleMap.setCenter(pos);
            googleMap.setZoom(14);

            geocoder.geocode({ location: pos }, function (results, status) {
                if (status === "OK" && results[0]) {
                    document.getElementById("location_inp").value =
                        results[0].formatted_address;
                    document.getElementById("lat_inp").value = pos.lat;
                    document.getElementById("lng_inp").value = pos.lng;
                }
            });
        });
    } else {
        console.log("Geolocation is not supported.");
    }
}

 