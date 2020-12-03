//api.openweathermap.org/data/2.5/forecast?q={city name}&appid={your api key}

const weatherApi = {
    key: "7ded80d91f2b280ec979100cc8bbba94",
    baseUrl: "https://api.openweathermap.org/data/2.5/weather" 
}

const searchInputBox = document.getElementById('input-box');

// Event Listener Function on keypress
searchInputBox.addEventListener('keypress', (event) => {

    if(event.keyCode ==13) {
        console.log(searchInputBox.Value);
        getWeatherReport(searchInputBox.value)
    }
});

// Get Weather Report
function getWeatherReport(city) {
    fetch(`${weatherApi.baseUrl}?q=${city}&appid=${weatherApi.key}&units=metric`)
    .then(weather => { 
        return weather.json();
    }).then(showWeatherReport);
}

// Show Weather Report
function showWeatherReport(weather){
    console.log(weather)

    let city = document.getElementById('city');
    city.innerText = `${weather.name}, ${weather.sys.country}`;

    let temperature = document.getElementById('temperature');
    temperature.innerHTML = `${Math.round(weather.main.temp)}&deg;C`;
    
    let description = document.getElementById('description');
    description.innerText = `${weather.weather[0].main}`;

    let windspeed = document.getElementById('windspeed');
    windspeed.innerHTML = `${weather.wind.speed}mps`;

    let date = document.getElementById('date');
    let todayDate = new Date();
    date.innerText = dateManage(todayDate);
    
    
    if(description.textContent == 'Clear') {
       
        document.getElementById("addsweath").style.backgroundImage = " url('img/Sunglasses_Ad.png') ";
        
    } else if(description.textContent == 'Clouds') {

        document.getElementById("addsweath").style.backgroundImage = " url('img/Jacket_Ad.png') ";
        
    } else if(description.textContent == 'Rain') {
        
        document.getElementById("addsweath").style.backgroundImage = " url('img/Umbrella_Ad.png') ";
    
        
    } else if(description.textContent == 'Snow') {
        document.getElementById("addsweath").style.backgroundImage = " url('img/Jacket_Ad.png') ";
    
    } else if(description.textContent == 'Haze') {
        document.getElementById("addsweath").style.backgroundImage = " url('img/WateringCan_Ad.png') ";
       
    
    } else if(description.textContent == 'Sunny') {
        document.getElementById("addsweath").style.backgroundImage = " url('img/Sunglasses_Ad.png') ";
    
    } 
    else if(description.textContent == 'Mist') {
        
        document.getElementById("addsweath").style.backgroundImage = " url('img/Jacket_Ad.png') ";
    
    } 
    else if(description.textContent == 'Thunder') {
        
        document.getElementById("addsweath").style.backgroundImage = " url('img/Umbrella_Ad.png') ";
    
        
    }
    else if(description.textContent == 'Storm') {
        
        document.getElementById("addsweath").style.backgroundImage = " url('img/Umbrella_Ad.png') ";
    
        
    }

    
}

    function dateManage(dateArg) {

        let days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    
        let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    
        let year = dateArg.getFullYear();
        let month = months[dateArg.getMonth()];
        let date = dateArg.getDate();
        let day = days[dateArg.getDay()];
    
        return `${date} ${month} (${day}), ${year}`;
    }




