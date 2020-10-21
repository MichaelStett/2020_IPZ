using Application.Weather.Models;

using System;
using System.Collections.Generic;
using System.Text;
using System.Threading.Tasks;

namespace Application.Common.Interfaces
{
    public interface IOpenWeatherClient
    {
        public Task<OpenWeatherResponse> GetWeather(double lat, double lon);
        public Task<OpenWeatherListResponse> GetWeather(List<double> bbox);
        public Task<OpenWeatherListResponse> GetWeather(double lat, double lon, int cnt);
    }
}
