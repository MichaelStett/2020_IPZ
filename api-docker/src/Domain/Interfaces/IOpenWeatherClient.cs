using System;
using System.Collections.Generic;
using System.Text;
using System.Threading.Tasks;

using Domain.Models;

namespace Domain.Interfaces
{
    public interface IOpenWeatherClient
    {
        public Task<OpenWeatherResponse> GetWeather(double lat, double lon);
        public Task<OpenWeatherListResponse> GetWeather(List<double> bbox);
        public Task<OpenWeatherListResponse> GetWeather(double lat, double lon, int cnt);
    }
}
