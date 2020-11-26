const baseURL = "http://api.openweathermap.org";
const apiKey = "44b1ea7b49afd0114a09932f574d54eb";

const getWeather = async (lat, lon, cnt) => {
    let endpoint = `/data/2.5/find?lat=${lat}&lon=${lon}&cnt=${cnt}&appid=${apiKey}&units=metric`;

    console.log(baseURL + endpoint)

    let response = await fetch(baseURL + endpoint);
    
    return await response.json();
}

const getWeekForecast = async (lat, lon) => {
    let endpoint = `/data/2.5/onecall?lat=${lat}&lon=${lon}&exclude=hourly,minutely&appid=${apiKey}&units=metric`
    
    console.log(baseURL + endpoint)
    let response = await fetch(baseURL + endpoint);
    
    return await response.json();
};

export { getWeather, getWeekForecast };
