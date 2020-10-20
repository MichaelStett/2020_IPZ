using System;
using System.Collections.Generic;
using System.Text;

namespace Domain.Models
{
    public class WeatherDescription
    {
        public int Id { get; set; }
        public string Main { get; set; }
        public string Description { get; set; }
    }
}
