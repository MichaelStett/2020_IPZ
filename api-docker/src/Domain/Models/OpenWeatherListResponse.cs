using System;
using System.Collections.Generic;
using System.Text;

namespace Domain.Models
{
    public class OpenWeatherListResponse
    {
        public List<OpenWeatherResponse> List { get; set; }
    }
}
