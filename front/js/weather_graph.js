    import { getWeekForecast } from './weatherapi.js';

    const getDataPoints = async () => {
        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        }
    
        var date = new Date();
    
        let { language } = window.navigator;
    
        let daysOfWeek = [];
    
        [...Array(7).keys()].forEach(i => {
             daysOfWeek.push(date.addDays(i).toLocaleString(language, { weekday: 'long' }))
        })
    
        let lat = 52.2297;
        let lon = 21.0122;
    
        let forecast = await getWeekForecast(lat, lon, 7);
        
        console.log(forecast)
    
        let days = []

        forecast.daily.forEach(day => { 
            days.push({ name: day.weather[0].main, min: day.temp.min, max: day.temp.max, icon: day.weather[0].icon});
        })
    
        let dataPoints = [];
    
        [...Array(7).keys()].forEach(i => {
            dataPoints.push({ label: daysOfWeek[i], y: [days[i].min, days[i].max], name: days[i].name, icon: days[i].icon})
        })

        return dataPoints;
    }

    getDataPoints().then(dataPoints => {

        function formatter(e) { 
            if (e.index === 0 && e.dataPoint.x === 0) {
                return " Min " + e.dataPoint.y[e.index] + "°";
            } else if (e.index == 1 && e.dataPoint.x === 0) {
                return " Max " + e.dataPoint.y[e.index] + "°";
            } else {
                return e.dataPoint.y[e.index] + "°";
            }
        } 

        console.table(dataPoints);

        
        var chart = new CanvasJS.Chart("chartContainer", {            
            title:{
                text: "Weekly Weather Forecast"              
            },
            axisY: {
                suffix: " °C",
                maximum: 20,
                minimum: -10,
                gridThickness: .5
            },
            toolTip:{
                shared: true,
                content: "{name} </br> Min: {y[0]} °C, Max: {y[1]} °C"
            },
            data: [{
                type: "rangeSplineArea",
                fillOpacity: 0.1,
                color: "#EC6E4C",
                indexLabelFormatter: formatter,
                dataPoints: dataPoints,
            }]
        });

        chart.render();
        
        var images = [];    
        
        addImages(chart);
        
        function addImages(chart) {
            for(var i = 0; i < chart.data[0].dataPoints.length; i++) {
                var dpsName = chart.data[0].dataPoints[i].name;

                var icon = chart.data[0].dataPoints[i].icon;

                images.push($("<img>").attr("src", `http://openweathermap.org/img/wn/${icon}@2x.png`));

                images[i].attr("class", dpsName).appendTo($("#chartContainer>.canvasjs-chart-container"));
                positionImage(images[i], i);
            }
        }
        
        function positionImage(image, index) {
            var imageCenter = chart.axisX[0].convertValueToPixel(chart.data[0].dataPoints[index].x);
            var imageTop =  chart.axisY[0].convertValueToPixel(chart.axisY[0].maximum);
        
            image.width("40px")
            .css({ 
                "left": imageCenter - 20 + "px",
                "position": "absolute",
                "top": imageTop + "px",
                "position": "absolute"
            });
        }
        
        $( window ).resize(function() {
            var cloudyCounter = 0, rainyCounter = 0, sunnyCounter = 0;    
            var imageCenter = 0;
            for(var i = 0; i < chart.data[0].dataPoints.length; i++) {
                imageCenter = chart.axisX[0].convertValueToPixel(chart.data[0].dataPoints[i].x) - 20;

                if(chart.data[0].dataPoints[i].name == "Clouds") {					
                    $(".clouds").eq(cloudyCounter++).css({ "left": imageCenter});
                } else if(chart.data[0].dataPoints[i].name == "Rain") {
                    $(".rain").eq(rainyCounter++).css({ "left": imageCenter});  
                } else if(chart.data[0].dataPoints[i].name == "Sunny") {
                    $(".sunny").eq(sunnyCounter++).css({ "left": imageCenter});  
                }                
            }
        });
    })
