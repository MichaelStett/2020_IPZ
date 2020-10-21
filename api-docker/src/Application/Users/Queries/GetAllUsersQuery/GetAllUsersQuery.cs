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

namespace Application.Users.Queries.GetAllUsersQuery
{
    public class GetAllUsersQuery : IRequest<IEnumerable<IdentityUser>>
    {
        public class GetAllUsersQueryHandler : IRequestHandler<GetAllUsersQuery, IEnumerable<IdentityUser>>
        {
            private readonly IContext _context;

            public GetAllUsersQueryHandler(IContext context)
                => (_context) = (context);

            public async Task<IEnumerable<IdentityUser>> Handle(GetAllUsersQuery request, CancellationToken cancellationToken)
            {
                var result = await _context.Users.ToListAsync();

                return result;
            }
        }
    }
}
