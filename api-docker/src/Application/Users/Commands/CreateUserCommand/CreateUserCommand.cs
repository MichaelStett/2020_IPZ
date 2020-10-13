using Domain.Entities;
using Domain.Interfaces;

using MediatR;

using System;
using System.Collections.Generic;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace Application.Users.Commands.CreateUserCommand
{
    public class CreateUserCommand : IRequest
    {
        public string Name { get; set; }
        public string EMail { get; set; }
        public string Password { get; set; }

        public class CreateUserCommandHandler : IRequestHandler<CreateUserCommand>
        {
            private readonly IContext _context;

            public CreateUserCommandHandler(IContext context)
                => (_context) = (context);

            public async Task<Unit> Handle(CreateUserCommand request, CancellationToken cancellationToken)
            {
                var user = new User
                {
                    Name = request.Name,
                    EMail = request.EMail,
                    Password = request.Password,
                };

                await _context.Users.AddAsync(user);

                await _context.SaveChangesAsync();

                return Unit.Value;
            }
        }
    }
}
