using System;
using System.Collections.Generic;
using System.Text;
using System.Threading.Tasks;

using Domain.Entities;
using Domain.Interfaces;

using Microsoft.EntityFrameworkCore;

namespace Infrastructure
{
    public class Context : DbContext, IContext
    {
        public Context(DbContextOptions<Context> options)
             : base(options)
        {
        }

        public DbSet<User> Users { get; set; }

        public async Task SaveChangesAsync()
        {
            base.SaveChanges();
        }
    }
}
