using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

using Application.System.Commands.CreateTokenCommand;
using Application.System.Commands.ValidateTokenCommand;

using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;

namespace API.Controllers
{
    public class SystemController : BaseController
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
            if (await CheckUser(command.Username, command.Password))
            {
                return base.Ok(await Mediator.Send(command));
            }

            return base.Unauthorized();
        }

        private async Task<bool> CheckUser(string username, string password)
        {
            return true;
        }
    }
}
