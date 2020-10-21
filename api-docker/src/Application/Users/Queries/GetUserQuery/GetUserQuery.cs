using Application.Common.Interfaces;

using MediatR;

using Microsoft.AspNetCore.Identity;
using Microsoft.EntityFrameworkCore;

using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace Application.Users.Queries.GetUserQuery
{
    public class GetUserQuery : IRequest<IdentityUser>
    {
        public string Id { get; set; }

        public class GetUserQueryHandler : IRequestHandler<GetUserQuery, IdentityUser>
        {
            private readonly IContext _context;

            public GetUserQueryHandler(IContext context)
                => (_context) = (context);

            public async Task<IdentityUser> Handle(GetUserQuery request, CancellationToken cancellationToken)
            {
                var users = await _context.Users.ToListAsync();

                return users.FirstOrDefault(u => u.Id == request.Id);
            }
        }
    }
}
