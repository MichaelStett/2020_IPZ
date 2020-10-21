using System;
using System.Collections.Generic;
using System.Text;

namespace Application.Weather.Models
{
    public class OpenWeatherResponse
    {
        public long Id { get; set; }

        public string Name { get; set; }

        public IEnumerable<WeatherDescription> Weather { get; set; }

        public CoordDescription Coord { get; set; }

        public Main Main { get; set; }
    }
}
