using Domain.Entities;
using Domain.Interfaces;

using MediatR;

using System;
using System.Collections.Generic;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace Application.Users.Commands.DeleteUserCommand
{
    public class DeleteUserCommand : IRequest
    {
        public int Id { get; set; }

        public class DeleteUserCommandHandler : IRequestHandler<DeleteUserCommand>
        {
            private readonly IContext _context;

            public DeleteUserCommandHandler(IContext context)
                => (_context) = (context);

            public async Task<Unit> Handle(DeleteUserCommand request, CancellationToken cancellationToken)
            {
                _context.Users.Remove(new User { Id = request.Id });

                await _context.SaveChangesAsync();

                return Unit.Value;
            }
        }
    }
}
