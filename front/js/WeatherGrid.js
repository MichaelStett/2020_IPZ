const WeatherGrid = class {
    constructor(weatherApi) {
        this.weatherApi = weatherApi;
    }

    createDefault = async (cityName, index) => {
            let data = await this.weatherApi.getWeatherByName(cityName);

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
                pressure: data.main.pressure,
                latitude: data.coord.lat,
                longitude: data.coord.lon
            };

            let currentWeatherElement = document.getElementById(`weather_${index}`)

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
                    </div>
            `
    }

    create = async (cityName, index) => {
        let data = await this.weatherApi.getWeatherByName(cityName);

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
            pressure: data.main.pressure,
            latitude: data.coord.lat,
            longitude: data.coord.lon
        };
        let currentWeatherElement = document.getElementById(`weather_${index}`)
        currentWeatherElement.innerHTML = `
                    <form action="./deleteFavourite.php"  method="POST">
                        <input type = hidden value="${cityName}" name="cityName">
                        <button type="submit" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </form>

                    <img src=${currentWeather.icon} style="width: 100px; height: 100px;" alt=${currentWeather.name}>
                    <div>
                        <h5>${currentWeather.cityName}</h5> 
                        <p>
                            <div>
                                <p><strong>${currentWeather.temperature.current}°C</strong>
                                but feels like: ${currentWeather.temperature.feelsLike}°C</p>
                            </div>
                        </p>
                    </div>
            `
    }
}   

export { WeatherGrid };