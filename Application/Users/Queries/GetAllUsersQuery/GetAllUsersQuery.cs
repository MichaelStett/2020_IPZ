using Domain.Entities;
using Domain.Interfaces;

using MediatR;

using Microsoft.EntityFrameworkCore;

using System;
using System.Collections.Generic;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace Application.Users.Queries.GetAllUsersQuery
{
    public class GetAllUsersQuery : IRequest<IEnumerable<User>>
    {
        public class GetAllUsersQueryHandler : IRequestHandler<GetAllUsersQuery, IEnumerable<User>>
        {
            private readonly IContext _context;

            public GetAllUsersQueryHandler(IContext context)
                => (_context) = (context);

            public async Task<IEnumerable<User>> Handle(GetAllUsersQuery request, CancellationToken cancellationToken)
            {
                return await _context.Users.ToListAsync();
            }
        }
    }
}
