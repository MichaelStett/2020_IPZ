using Application.Common.Interfaces;
using Application.Weather.Models;

using Newtonsoft.Json;

using RestSharp;

using System;
using System.Collections.Generic;
using System.Net;
using System.Threading.Tasks;

namespace Application.Common.Clients
{
    public class OpenWeatherClient : RestClient, IOpenWeatherClient
    {
        internal readonly string URL = "http://api.openweathermap.org";

        internal static string _apiKey;

        public static void SetApiCredentials(string apiKey)
        {
            _apiKey = apiKey;

        }

        public async Task<OpenWeatherResponse> GetWeather(double lat, double lon)
        {
            var s = $"/data/2.5/weather?lat={lat}&lon={lon}&appid={_apiKey}";

            var result = await this.ExecuteAsync<OpenWeatherResponse>(s);

            return result;
        }

        public async Task<OpenWeatherListResponse> GetWeather(List<double> bbox)
        {
            var bboxString = string.Join(",", bbox);

            var s = $"/data/2.5/box/city?bbox={bboxString}&appid={_apiKey}";

            var result = await this.ExecuteAsync<OpenWeatherListResponse>(s);

            return result;
        }

        public async Task<OpenWeatherListResponse> GetWeather(double lat, double lon, int cnt)
        {
            var s = $"/data/2.5/find?lat={lat}&lon={lon}&cnt={cnt}&appid={_apiKey}";

            var result = await this.ExecuteAsync<OpenWeatherListResponse>(s);

            return result;
        }

        private async Task<T> ExecuteAsync<T>(string s)
        {
            base.BaseUrl = new Uri(URL);

            var request = new RestRequest(s, Method.GET);

            var content = await base.ExecuteAsync(request);

            if (content.StatusCode != HttpStatusCode.OK)
            {
                throw new Exception();
            }

            var result = JsonConvert.DeserializeObject<T>(content.Content);

            return result;
        }
    }
}
