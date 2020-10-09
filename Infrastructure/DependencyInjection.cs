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
            if (Environment.GetEnvironmentVariable("ASP.NET_ENVIROMENT") == "Production")
                services.AddDbContext<Context>(opt =>
                    opt.UseSqlServer(configuration.GetConnectionString("DatabaseAzure")));
            else
                services.AddDbContext<Context>(opt =>
                    opt.UseSqlServer(configuration.GetConnectionString("DatabaseLocal")));


            services.BuildServiceProvider().GetService<Context>().Database.Migrate();

            //services.AddDefaultIdentity<IdentityUser>()
            //    .AddEntityFrameworkStores<ApplicationDbContext>();


            services.AddScoped<IContext, Context>();

        }
    }
}
