const WeatherApi = class {
    constructor(apiKey) {
        WeatherApi.suffix = `&appid=${apiKey}&units=metric`
    }

    // const~
    static get baseURL() { return "https://api.openweathermap.org/data/2.5/" };

    getWeatherByName = async (cityName) => {
        let endpoint = `weather?q=${cityName}`;

        let url = WeatherApi.baseURL + endpoint + WeatherApi.suffix;

        let response = await fetch(url);

        return await response.json();
    }

    getForecastByName = async (cityName) => {
        let endpoint = `forecast?q=${cityName}`;

        let url = WeatherApi.baseURL + endpoint + WeatherApi.suffix;

        let response = await fetch(url);

        return await response.json();
    }

    getWeekForecast = async (lat, lon) => {
        let endpoint = `onecall?lat=${lat}&lon=${lon}&exclude=hourly,minutely`;
        
        let url = WeatherApi.baseURL + endpoint + WeatherApi.suffix;
        
        let response = await fetch(url);
        
        return await response.json();
    }

    getWeatherByPosition = async (lat, lon) => {
        let endpoint = `weather?lat=${lat}&lon=${lon}`;

        let url = WeatherApi.baseURL + endpoint + WeatherApi.suffix;

        let response = await fetch(url);

        return await response.json();
    }
}

export { WeatherApi };