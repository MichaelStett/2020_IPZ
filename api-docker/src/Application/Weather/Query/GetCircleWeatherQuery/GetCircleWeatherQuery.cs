using Application.Common.Interfaces;
using Application.Weather.Models;

using MediatR;

using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations;
using System.Runtime.InteropServices;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace Application.Weather.Query.GetCircleWeatherQuery
{
    public class GetCircleWeatherQuery : IRequest<OpenWeatherListResponse>
    {
        [Required]
        [Range(minimum: -90, maximum: 90,
            ErrorMessage = "Value for {0} must be between {1} and {2}.")]
        public double Longitude { get; set; }

        [Required]
        [Range(minimum: -180, maximum: 180,
            ErrorMessage = "Value for {0} must be between {1} and {2}.")]
        public double Latitude { get; set; }

        [Required]
        [DefaultValue(5)]
        [Range(minimum: 5, maximum: 50,
            ErrorMessage = "Value for {0} must be between {1} and {2}.")]
        public int Count { get; set; }

        public class GetCircleWeatherQueryHandler : IRequestHandler<GetCircleWeatherQuery, OpenWeatherListResponse>
        {
            private readonly IOpenWeatherClient _client;

            public GetCircleWeatherQueryHandler(IOpenWeatherClient client)
            {
                _client = client;
            }

            public async Task<OpenWeatherListResponse> Handle(GetCircleWeatherQuery request, CancellationToken cancellationToken)
            {
                var response = await _client.GetWeather(request.Latitude, request.Longitude, request.Count);

                return response;
            }
        }
    }
}