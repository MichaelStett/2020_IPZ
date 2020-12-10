import { WeatherApi } from './WeatherApi.js';
import { LeafletMap } from './LeafletMap.js';
import { DateTime } from './DateTime.js';
import { WeatherChart } from './WeatherChart.js';

const api = new WeatherApi("7ded80d91f2b280ec979100cc8bbba94");
const map = new LeafletMap(api, "e97c7311758c0dc6edec263d72155863");
const dt = new DateTime();
const chart = new WeatherChart(map, api, dt);

chart.create();

setInterval(dt.refreshDateLayer, 1000);

// Permissions
navigator.permissions.query({ name: 'geolocation' })

// Listeners
getLocationButton.addEventListener("click", navigator.geolocation.getCurrentPosition(map.refreshLocation))

removeMarkersButton.addEventListener("click", map.removeAllMarkers);

const getWeatherForSearchedCity = async () => {
    let cityName = searchInput.value;

        if (cityName.length >= 3) {
            let data = await api.getWeatherByName(cityName);
            // Centering map on searched city
            map.map.setView([data.coord.lat, data.coord.lon]);
            //
            // chart.options.data[0].dataPoints = 


            let currentWeather = { 
                cityName: cityName, 
                icon: `https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`,
                name: data.weather[0].main,
                temperature: {
                    current: data.main.temp,
                    min: data.main.temp_min,
                    max: data.main.temp_max,
                    feelsLike: data.main.feels_like
                },
                humidity: data.main.humidity,
                pressure: data.main.pressure
            };

            let currentWeatherElement = document.createElement("div");

            currentWeatherElement.innerHTML = `
                    <img src=${currentWeather.icon} style="width: 100px; height: 100px;" alt=${currentWeather.name}>
                    <div>
                        <h5>${currentWeather.cityName}</h5> 
                        <p>
                            <div>
                                <p><strong>${currentWeather.temperature.current}°C</strong>
                                but feels like: ${currentWeather.temperature.feelsLike}°C</p>
                            </div>
                        </p>
                        <p><small>Humidity: ${currentWeather.humidity}% Pressure: ${currentWeather.pressure}hPA</small></p>
                    </div>
            `

            searchedWeather.innerHTML = '';
            searchedWeather.appendChild(currentWeatherElement);
        }

}

getWeatherButton.addEventListener("click", getWeatherForSearchedCity);
