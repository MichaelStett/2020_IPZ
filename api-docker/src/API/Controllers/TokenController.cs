using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

using Application.Token.Commands.CreateTokenCommand;
using Application.Token.Commands.ValidateTokenCommand;

using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;

namespace API.Controllers
{
    public class TokenController : BaseController
    {
        [AllowAnonymous]
        [HttpGet]
        public async Task<ActionResult<bool>> Get(string token)
        {
            return base.Ok(await Mediator.Send(new ValidateTokenCommand { Token = token }));
        }

        [AllowAnonymous]
        [HttpPost]
        public async Task<ActionResult<string>> Get([FromBody] CreateTokenCommand command)
        {
            return base.Ok(await Mediator.Send(command));
        }

    }
}
