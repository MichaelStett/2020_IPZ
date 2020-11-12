import { getWeather } from './weatherapi.js';

//#region Location

const access_token = "pk.eyJ1IjoibWljaGFlbHN0ZXR0IiwiYSI6ImNrZ3R3dW9vdzExbm8ycW1mMWRiZDZwMXQifQ.PjXKXl0zpEcJ88JyhuT-yQ";

// https://leafletjs.com/reference-1.7.1.html
let latitude = 52.2297;
let longitude = 21.0122;

let map = L.map('mapid').setView([latitude, longitude], 12);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        maxZoom: 20,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: access_token
}).addTo(map);


let markers = [];

function onMapClick(e) {
    let lat = e.latlng.lat.toFixed(4);
    let lon = e.latlng.lng.toFixed(4);

    var marker = L.marker([lat, lon]).addTo(map);

    var popup = L.popup()
        .setContent(`Cliked on: ${lat}, ${lon}`);

    marker.bindPopup(popup).openPopup();

    markers.push(marker);
}

function onLocationFound(e) {
    const options = {
        // customize: https://leafletjs.com/reference-1.0.3.html#popup
    };

    let radius = e.accuracy;

    let popup = L.popup(options)
        .setContent("You are within " + radius + " meters from this point.");
        
    // https://github.com/pointhi/leaflet-color-markers
    var icon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    L.marker(e.latlng, { icon }).addTo(map)
        .bindPopup(popup).openPopup();

    L.circle(e.latlng, radius).addTo(map);
}

function onLocationError(e) {
    alert(e.message);
}

function refreshMapLocation(position) {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;

    let data = getWeather(latitude, longitude, 1);
    
    data.then(d => {
        if (d) {
            console.log(d)

            let item = d.list[0]; 

            currentLocation.innerText = `${item.name}: ${latitude}, ${longitude}`;
            currentTemperature.innerText = `${item.weather[0].main} - High: ${item.main.temp_max}°C Low: ${item.main.temp_min}°C`;
        }
    })

    map.setView([latitude, longitude]);
    
    map.locate({setView: true, maxZoom: 16});

    map.on('locationfound', onLocationFound);

    map.on('locationerror', onLocationError);

    map.on('click', onMapClick);
}


function error() {
    alert(`ERROR(${error.code}): ${error.message}`);
}

function getCurrentLocation() {
    if ('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition((position) => {
            refreshMapLocation(position);
        });
    } else {
        error() 
    }
}

getLocationButton.addEventListener("click", _ => getCurrentLocation())

removeMarkers.addEventListener("click", _ => {
    if (markers.length > 0){
        markers.forEach(marker => {
            map.removeLayer(marker)
        })
    }
})
//#endregion

//#region  Clock 
function refreshDateLayer() {
    let date = new Date();

    let { language } = window.navigator;

    let todayDate = date.toLocaleDateString(language, { year: 'numeric', month: 'long', day: 'numeric' })

    let dayOfWeek = date.toLocaleString(language, { weekday: 'long' })

    let time = date.toLocaleTimeString(language, { hour: '2-digit', minute: '2-digit' });

    dataLayer.innerHTML = `Today is ${dayOfWeek}, ${todayDate} <br> ${time}`;
  }

  refreshDateLayer();

  setTimeout(refreshDateLayer, 60*1000); // each minute
//#endregion

// $('#adsCarousel').carousel({
//     interval: 2000
//   });