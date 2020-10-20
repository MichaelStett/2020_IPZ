using Domain.Interfaces;
using Domain.Models;

using MediatR;

using System;
using System.Collections.Generic;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace Application.Weather.Query.GetCircleWeatherQuery
{
    public class GetCircleWeatherQuery : IRequest<OpenWeatherListResponse>
    {
        public double Longitude { get; set; }
        public double Latitude { get; set; }
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