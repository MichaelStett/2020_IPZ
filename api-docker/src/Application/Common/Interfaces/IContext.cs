using Microsoft.AspNetCore.Identity;
using Microsoft.EntityFrameworkCore;

using System;
using System.Collections.Generic;
using System.Text;
using System.Threading.Tasks;

namespace Application.Common.Interfaces
{
    public interface IContext
    {
        public DbSet<IdentityUser> Users { get; set; }

        Task SaveChangesAsync();
    }
}
