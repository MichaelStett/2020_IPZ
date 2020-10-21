using System;
using System.Collections.Generic;
using System.Text;

namespace Application.Weather.Models
{
    public class OpenWeatherListResponse
    {
        public List<OpenWeatherResponse> List { get; set; }
    }
}
