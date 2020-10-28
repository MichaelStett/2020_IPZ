const access_token = "pk.eyJ1IjoibWljaGFlbHN0ZXR0IiwiYSI6ImNrZ3R3dW9vdzExbm8ycW1mMWRiZDZwMXQifQ.PjXKXl0zpEcJ88JyhuT-yQ";


// https://leafletjs.com/reference-1.7.1.html

let longitude = 51.505;
let latitude = -0.09;
let map = null;

function onMapClick(e) {
    let lat = e.latlng.lat.toFixed(4);
    let lon = e.latlng.lng.toFixed(4);

    var marker = L.marker([lat, lon]).addTo(map);

    var popup = L.popup()
        .setContent(`Cliked on: ${lat}, ${lon}`);

    marker.bindPopup(popup).openPopup();
}

//#region Current Location
function updateLocation(position) {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;

    currentLocation.innerText = `${latitude}, ${longitude}`;
    map = L.map('mapid').setView(
        [latitude, longitude],
        13);
    
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery &copy; <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 14,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: access_token
    }).addTo(map);

    map.on('click', onMapClick);
}

function error() {
    alert(`ERROR(${error.code}): ${error.message}`);
}

if ('geolocation' in navigator) {
    navigator.geolocation.getCurrentPosition((position) => {
        updateLocation(position);
    });
} else {
    error() 
}
