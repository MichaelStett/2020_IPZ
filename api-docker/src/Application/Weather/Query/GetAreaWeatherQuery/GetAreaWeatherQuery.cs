using Application.Common.Interfaces;
using Application.Weather.Models;

using MediatR;

using System;
using System.Collections.Generic;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace Application.Weather.Query.GetAreaWeatherQuery
{
    public class GetAreaWeatherQuery : IRequest<OpenWeatherListResponse>
    {
        public double LongitudeLeft { get; set; }
        public double LatitudeBottom { get; set; }
        public double LongitudeRight { get; set; }
        public double LatitudeTop { get; set; }
        public int Zoom { get; set; }


        public class GetLocalizedWeatherQueryHandler : IRequestHandler<GetAreaWeatherQuery, OpenWeatherListResponse>
        {
            private readonly IOpenWeatherClient _client;

            public GetLocalizedWeatherQueryHandler(IOpenWeatherClient client)
            {
                _client = client;
            }

            public async Task<OpenWeatherListResponse> Handle(GetAreaWeatherQuery request, CancellationToken cancellationToken)
            {
                var bbox = new List<double>()
                {
                    request.LongitudeLeft,
                    request.LatitudeBottom,
                    request.LongitudeRight,
                    request.LatitudeTop,
                    request.Zoom
                };

                var response = await _client.GetWeather(bbox);


                return response;
            }
        }
    }
}
