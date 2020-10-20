using Domain.Interfaces;
using Domain.Models;

using MediatR;

using System.Threading;
using System.Threading.Tasks;

namespace Application.Weather.Query.GetLocalizedWeatherQuery
{
    public class GetLocalizedWeatherQuery : IRequest<OpenWeatherResponse>
    {
        public int Longitude { get; set; }
        public int Latitude { get; set; }

        public class GetLocalizedWeatherQueryHandler : IRequestHandler<GetLocalizedWeatherQuery, OpenWeatherResponse>
        {
            private readonly IOpenWeatherClient _client;

            public GetLocalizedWeatherQueryHandler(IOpenWeatherClient client)
            {
                _client = client;
            }

            public async Task<OpenWeatherResponse> Handle(GetLocalizedWeatherQuery request, CancellationToken cancellationToken)
            {
                var response = await _client.GetWeather(lat: request.Latitude, lon: request.Longitude);

                return response;
            }
        }
    }
}
