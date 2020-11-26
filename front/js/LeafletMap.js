const access_token = "pk.eyJ1IjoibWljaGFlbHN0ZXR0IiwiYSI6ImNrZ3R3dW9vdzExbm8ycW1mMWRiZDZwMXQifQ.PjXKXl0zpEcJ88JyhuT-yQ";

const LeafletMap = class {
    constructor(weatherApi, apiKey) {
        this.weatherApi = weatherApi;
        this.apiKey = apiKey;

        this.latitude = 52.2297;
        this.longitude = 21.0122;
        this.markers = [];

        this.map = L.map('mapid').setView([this.latitude, this.longitude], 12);

        let precipitation = L.tileLayer(`https://tile.openweathermap.org/map/precipitation_new/{z}/{x}/{y}.png?appid=${apiKey}`)
        let clouds = L.tileLayer(`https://tile.openweathermap.org/map/clouds_new/{z}/{x}/{y}.png?appid=${apiKey}`)
        let temperature = L.tileLayer(`https://tile.openweathermap.org/map/temp_new/{z}/{x}/{y}.png?appid=${apiKey}`)

        L.control.layers({
            "Precipitation": precipitation,
            "Clouds": clouds,
            "Temperature": temperature
        }).addTo(this.map);

        L.tileLayer(`https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=${access_token}`, {
            maxZoom: 20,
            tileSize: 512,
            id: 'mapbox/streets-v11',
            zoomOffset: -1,
            layers: [precipitation, clouds, temperature]
        }).addTo(this.map);
    }

    refreshLocation = async (position) => {
        this.latitude = position.coords.latitude;
        this.longitude = position.coords.longitude;
    
        let data = await this.weatherApi.getWeatherByPosition(this.latitude, this.longitude)
        
        if (data) {
            currentLocation.innerText = `${data.name}: ${this.latitude}, ${this.longitude}`;
            // currentTemperature.innerText = `${data.weather[0].main} - High: ${data.main.temp_max}°C Low: ${data.main.temp_min}°C`;
        }
    
        this.map.setView([this.latitude, this.longitude]);
        
        this.map.locate({ setView: true, maxZoom: 16 });
    
        this.map.on('locationfound', e => {
            // TODO? : customize popup -> https://leafletjs.com/reference-1.0.3.html#popup
            let radius = e.accuracy;
        
            let popup = L.popup()
                .setContent("You are within " + radius + " meters from this point.");
                
            // https://github.com/pointhi/leaflet-color-markers
            let icon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
        
            L.marker(e.latlng, { icon }).addTo(this.map)
                .bindPopup(popup).openPopup();
        
            L.circle(e.latlng, radius).addTo(this.map);
        });
    
        this.map.on('locationerror', e => alert(e.message));
    
        this.map.on('click',  e => {
            let lat = e.latlng.lat.toFixed(4);
            let lon = e.latlng.lng.toFixed(4);
        
            var marker = L.marker([lat, lon]).addTo(this.map);
        
            var popup = L.popup()
                .setContent(`Cliked on: ${lat}, ${lon}`);
        
            marker.bindPopup(popup).openPopup();
        
            this.markers.push(marker);
        });
    }

    removeAllMarkers = () => {
        if (this.markers.length > 0){
            this.markers.forEach(marker => {
                this.map.removeLayer(marker)
            })
        }
    }
}

export { LeafletMap }