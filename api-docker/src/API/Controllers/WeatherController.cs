using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

using Application.Weather.Query.GetAreaWeatherQuery;
using Application.Weather.Query.GetCircleWeatherQuery;
using Application.Weather.Query.GetLocalizedWeatherQuery;

using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace API.Controllers
{
    public class WeatherController : BaseController
    {
        [HttpGet]
        public async Task<IActionResult> GetSingle([FromQuery] int longitude, [FromQuery] int latitude)
        {
            return base.Ok(await Mediator.Send(new GetLocalizedWeatherQuery { Longitude = longitude, Latitude = latitude }));
        }

        [HttpGet]
        [Route("area")]
        public async Task<IActionResult> GetArea([FromQuery] GetAreaWeatherQuery query)
        {
            return base.Ok(await Mediator.Send(query));
        }

        [HttpGet]
        [Route("circle")]
        public async Task<IActionResult> GetCircle([FromQuery] GetCircleWeatherQuery query)
        {
            return base.Ok(await Mediator.Send(query));
        }
    }
}
