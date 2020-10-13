using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

using Application.Accounts.Commands.DeleteAccountCommand;
using Application.Accounts.Commands.RegisterAccountCommand;

using MediatR;

using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace API.Controllers
{
    public class AccountsController : BaseController
    {
        [HttpPost]
        public async Task<IActionResult> Register([FromBody] RegisterAccountCommand command)
        {
            var result = await Mediator.Send(command);

            return base.Ok(result);
        }

        //[HttpPost]
        //public async Task<IActionResult> Login([FromBody] CreateUserCommand command)
        //{
        //    return base.Ok(await Mediator.Send(command));
        //}

        [HttpDelete("{id}")]
        public async Task<IActionResult> Delete(string id)
        {
            var isFoundAndDeleted = await Mediator.Send(new DeleteAccountCommand { Id = id });

            if (!isFoundAndDeleted)
                return base.NotFound();

            return base.NoContent();
        }
    }
}
