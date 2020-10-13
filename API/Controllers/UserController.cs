using Application.Users.Commands.CreateUserCommand;
using Application.Users.Commands.DeleteUserCommand;
using Application.Users.Queries.GetAllUsersQuery;
using Application.Users.Queries.GetUserQuery;

using Domain.Entities;

using MediatR;

using Microsoft.AspNetCore.Mvc;

using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace API.Controllers
{
    public class UserController : BaseController
    {
        [HttpGet]
        public async Task<ActionResult<IEnumerable<User>>> Get()
        {
            return base.Ok(await Mediator.Send(new GetAllUsersQuery()));
        }

        [HttpGet("{id}")]
        public async Task<ActionResult<User>> Get(int id)
        {
            return base.Ok(await Mediator.Send(new GetUserQuery { Id = id }));
        }

        [HttpPost]
        public async Task<ActionResult<Unit>> Post([FromBody] CreateUserCommand command)
        {
            return base.Ok(await Mediator.Send(command));
        }

        [HttpDelete("{id}")]
        public async Task<ActionResult<Unit>> Delete(int id)
        {
            return base.Ok(await Mediator.Send(new DeleteUserCommand { Id = id }));
        }
    }
}
