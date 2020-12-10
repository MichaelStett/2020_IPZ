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

//adds range for specific temperature in that range :
let tempRanges = [{low: 0, high: 8, image: 'img/Jacket_Ad.png',descrip:'Only for you: Smooth woven fabric with synthetic filling for lightweight warmth. Made with recycled polyester. Plastic bottles and textile waste are processed into plastic chips and melted into new fibres. This saves water and energy and reduces greenhouse-gas emissions!'},{low:8,high:16,image:'img/Umbrella_Ad.png',descrip:'Only for you: This windproof, automatic opening recycled umbrella has a vented overlapping canopy, black rubber finished handle and carbon fibre ribs. 90 cm long. Canopy span 120 cm.'} ,{low: 16, high: 20, image: 'img/Sunglasses_Ad.png',descrip:' Only for you: Designed and crafted in Italy. Crystal-tempered sunglass lenses provide protection with distortion-free vision. With a brand character that can best be described as classy, exclusive, stylish, and unique, SUNNY continues to go beyond trends.'}, {low: 20, high: 30, image: 'img/WateringCan_Ad.png',descrip:'Only for you: CONNY watering can is a trusted solution designed mainly for gardening activities. With a removable sieve. The large handle increases the comfort of use. Resistant to mechanical damage and UV-light.  Available in 2 sizes – with capacity of 1.8 and 4.5 litre – and 4 colour options.  '}];

    function findRangeByTemperature(temp) {
       return tempRanges.find(range => {
          return temp >= range.low && temp < range.high;
       });
    }
    /////

const getWeatherForSearchedCity = async () => {
    let cityName = searchInput.value;

        if (cityName.length >= 3) {
            let data = await api.getWeatherByName(cityName);

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
//adds only with image 
let range = findRangeByTemperature(data.main.temp);
if(range) {
    //rand image
    $("#addsweath").attr("src", range.image);
    $("#addsdescrip").attr("src",range.descrip);
}
else {
    //nie znaleziono takiej rangi
}

            //do starej wersji wyszukiwania po miescie

           /* if(name.textContent == 'Clear') {
                //document.getElementById("addsweath").src = "img/Sunglasses_Ad.png";
                document.getElementById("addsweath").style.animationName= " url('img/Sunglasses_Ad.png') " ;
                document.getElementById("addsdescrip").innerText=" Only for you: Designed and crafted in Italy. Crystal-tempered sunglass lenses provide protection with distortion-free vision. With a brand character that can best be described as classy, exclusive, stylish, and unique, SUNNY continues to go beyond trends.";
                
            } else if(name.textContent == 'Clouds') {
        
                document.getElementById("addsweath").style.backgroundImage = " url('img/Jacket_Ad.png') ";
                document.getElementById("addsdescrip").innerText=" Only for you: Smooth woven fabric with synthetic filling for lightweight warmth. Made with recycled polyester. Plastic bottles and textile waste are processed into plastic chips and melted into new fibres. This saves water and energy and reduces greenhouse-gas emissions! ";
            } else if(name.textContent == 'Rain') {
                
                document.getElementById("addsweath").style.backgroundImage = " url('img/Umbrella_Ad.png') ";
                document.getElementById("addsdescrip").innerText="Only for you: This windproof, automatic opening recycled umbrella has a vented overlapping canopy, black rubber finished handle and carbon fibre ribs. 90 cm long. Canopy span 120 cm.";
                
            } else if(name.textContent == 'Snow') {
                document.getElementById("addsweath").style.backgroundImage = " url('img/Jacket_Ad.png') ";
                document.getElementById("addsdescrip").innerText="Only for you: Smooth woven fabric with synthetic filling for lightweight warmth. Made with recycled polyester. Plastic bottles and textile waste are processed into plastic chips and melted into new fibres. This saves water and energy and reduces greenhouse-gas emissions! ";
            } else if(name.textContent == 'Haze') {
                document.getElementById("addsweath").style.backgroundImage = " url('img/WateringCan_Ad.png') ";
                document.getElementById("addsdescrip").innerText="Only for you: CONNY watering can is a trusted solution designed mainly for gardening activities. With a removable sieve. The large handle increases the comfort of use. Resistant to mechanical damage and UV-light.  Available in 2 sizes – with capacity of 1.8 and 4.5 litre – and 4 colour options.  ";
            
            } else if(name.textContent == 'Sunny') {
                document.getElementById("addsweath").style.backgroundImage = " url('img/Sunglasses_Ad.png') ";
                document.getElementById("addsdescrip").innerText="Only for you: Designed and crafted in Italy. Crystal-tempered sunglass lenses provide protection with distortion-free vision. With a brand character that can best be described as classy, exclusive, stylish, and unique, SUNNY continues to go beyond trends.";
                
            } 
            else if(name.textContent == 'Mist') {
                
                document.getElementById("addsweath").style.backgroundImage = " url('img/Jacket_Ad.png') ";
                document.getElementById("addsdescrip").innerText="Only for you: Smooth woven fabric with synthetic filling for lightweight warmth. Made with recycled polyester. Plastic bottles and textile waste are processed into plastic chips and melted into new fibres. This saves water and energy and reduces greenhouse-gas emissions! ";
            } 
            else if(name.textContent == 'Thunder') {
                
                document.getElementById("addsweath").style.backgroundImage = " url('img/Umbrella_Ad.png') ";
                document.getElementById("addsdescrip").innerText="Only for you: This windproof, automatic opening recycled umbrella has a vented overlapping canopy, black rubber finished handle and carbon fibre ribs. 90 cm long. Canopy span 120 cm.";
                
                
            }
            else if(name.textContent == 'Storm') {
                
                document.getElementById("addsweath").style.backgroundImage = " url('img/Umbrella_Ad.png') ";
                document.getElementById("addsdescrip").innerText="Only for you: This windproof, automatic opening recycled umbrella has a vented overlapping canopy, black rubber finished handle and carbon fibre ribs. 90 cm long. Canopy span 120 cm.";
                
                
            }*/

            
        }
        
}

getWeatherButton.addEventListener("click", getWeatherForSearchedCity);
