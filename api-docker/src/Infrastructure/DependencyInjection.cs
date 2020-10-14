using System;
using System.Collections.Generic;
using System.Text;


using Microsoft.AspNetCore.Identity;
using Microsoft.EntityFrameworkCore;
using Microsoft.Extensions.Configuration;
using Microsoft.Extensions.DependencyInjection;

using Domain.Interfaces;

namespace Infrastructure
{
    public static class DependencyInjection
    {
        public static void AddInfrastructure(this IServiceCollection services, IConfiguration configuration)
        {
            services.AddDbContext<Context>(opt =>
                opt.UseSqlServer(configuration.GetConnectionString("Database")));

            services.AddIdentity<IdentityUser, IdentityRole>(opt => {
                opt.Password.RequiredLength = 8;
                opt.Password.RequiredUniqueChars = 0;
                opt.Password.RequireDigit = true;
                opt.Password.RequireUppercase = false;
                opt.Password.RequireNonAlphanumeric = false;
            }).AddEntityFrameworkStores<Context>();

            //services.AddDbContext<Context>(opt =>
            //    opt.UseSqlServer(configuration.GetConnectionString("DatabaseAzure")));

            services.AddScoped<IContext, Context>();

            services.BuildServiceProvider().GetService<Context>().Database.Migrate();
        }
    }
}
