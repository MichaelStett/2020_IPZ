using System;
using System.Collections.Generic;
using System.Text;
using System.Threading.Tasks;

using Domain.Interfaces;

using Microsoft.AspNetCore.Identity.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore;

namespace Infrastructure
{
    public class Context : IdentityDbContext, IContext
    {
        public Context(DbContextOptions<Context> options)
             : base(options)
        {
        }

        public async Task SaveChangesAsync()
        {
            base.SaveChanges();
        }
    }
}
