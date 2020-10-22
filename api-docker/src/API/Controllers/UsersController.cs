using Application.Users.Queries.GetAllUsersQuery;
using Application.Users.Queries.GetUserQuery;


using MediatR;

using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Identity;
using Microsoft.AspNetCore.Mvc;

using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace API.Controllers
{
    public class UsersController : BaseController
    {
        [HttpGet]
        public async Task<IActionResult> GetAll()
        {
            return base.Ok(await Mediator.Send(new GetAllUsersQuery()));
        }

        [HttpGet("{id}")]
        public async Task<IActionResult> GetUser(string id)
        {
            return base.Ok(await Mediator.Send(new GetUserQuery { Id = id }));
        }

        [HttpPost("authenticate")]
        public async Task<IActionResult> Authenticate(string id)
        {
            return base.Ok(await Mediator.Send(new GetUserQuery { Id = id }));
        }
    }
}
