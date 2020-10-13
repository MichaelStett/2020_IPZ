using Domain.Entities;

using Microsoft.EntityFrameworkCore;

using System;
using System.Collections.Generic;
using System.Text;
using System.Threading.Tasks;

namespace Domain.Interfaces
{
    public interface IContext
    {
        DbSet<User> Users { get; set; }

        Task SaveChangesAsync();
    }
}
