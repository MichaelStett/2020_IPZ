const WeatherChart = class {
    constructor(leafltetMap, weatherApi, dateTime) {
        this.leafltetMap = leafltetMap;
        this.weatherApi = weatherApi;
        this.dateTime = dateTime;
    }

    create = async () => {
        let dataPoints = await this._getDataPoints();

        let min = Math.min(...dataPoints.map(points => points.y[0]))
        let max = Math.max(...dataPoints.map(points => points.y[1]))

        let chart = new CanvasJS.Chart('weatherChart', {            
            title:{
                text: "Weekly Weather Forecast"              
            },
            axisY: {
                suffix: " °C",
                maximum: max + 4,
                minimum: min - 3,
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
                indexLabelFormatter: this._formatter,
                dataPoints: dataPoints,
            }]
        });

        chart.render();

        // add Images to chart
        chart.data[0].dataPoints.forEach(dataPoint => {
            let { name, icon } = dataPoint;

            let image = $("<img>").attr("src", `http://openweathermap.org/img/wn/${icon}@2x.png`);

            image.attr("class", name);

            image.appendTo($("#weatherChart>.canvasjs-chart-container"));

           // position Image inside chart
           let imageCenter = chart.axisX[0].convertValueToPixel(dataPoint.x);
           let imageTop = chart.axisY[0].convertValueToPixel(chart.axisY[0].maximum);
       
           image.width("40px")
           .css({ 
               "left": imageCenter - 20 + "px",
               "position": "absolute",
               "top": imageTop + "px"
           });
            
        })

        $( window ).resize(function() {

            // all possible weather conditions
            let counters = {
                "Clouds": 0,
                "Clear": 0,
                "Atmosphere": 0,
                "Snow": 0,
                "Rain": 0,
                "Drizzle": 0,
                "Thunderstorm": 0,
            }

            chart.data[0].dataPoints.forEach(dataPoint => { 
                let imageCenter = chart.axisX[0].convertValueToPixel(dataPoint.x) - 20;

                $(`.${dataPoint.name}`).eq(counters[dataPoint.name]++).css({ "left": imageCenter});  
            });
        })
    }

    _getDataPoints = async () => {
        let daysOfWeek = this.dateTime.daysOfWeek;
    
        let { latitude, longitude } = this.leafltetMap;

        let forecast = await this.weatherApi.getWeekForecast(latitude, longitude);
        
        let dataPoints = [];
    
        forecast.daily.forEach((day, i) => {
            dataPoints.push({ label: daysOfWeek[i], y: [day.temp.min, day.temp.max], name: day.weather[0].main, icon: day.weather[0].icon})
        })

        dataPoints.pop()
    
        return dataPoints;
    }

    _formatter = (e) => { 
        if (e.index === 0 && e.dataPoint.x === 0) {
            return " Min " + e.dataPoint.y[e.index] + "°";
        } else if (e.index == 1 && e.dataPoint.x === 0) {
            return " Max " + e.dataPoint.y[e.index] + "°";
        } else {
            return e.dataPoint.y[e.index] + "°";
        }
    } 
}

export { WeatherChart };