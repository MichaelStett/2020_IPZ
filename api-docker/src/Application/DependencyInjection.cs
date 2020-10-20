using System;
using System.Collections.Generic;
using System.Reflection;
using System.Text;

using Microsoft.Extensions.DependencyInjection;

using MediatR;
using AutoMapper;
using Microsoft.Extensions.Options;
using Application.Common.Settings;
using Application.Common.Clients;
using Domain.Interfaces;

namespace Application
{
    public static class DependencyInjection
    {
        public static void AddApplication(this IServiceCollection services)
        {
            services.AddAutoMapper(Assembly.GetExecutingAssembly());
            services.AddMediatR(Assembly.GetExecutingAssembly());

            services.AddTransient<IOpenWeatherClient, OpenWeatherClient>();

            var sp = services.BuildServiceProvider();
            var settings = sp.GetService<IOptions<OpenWeatherSettings>>();

            OpenWeatherClient.SetApiCredentials(settings.Value.ApiKey);
        }
    }
}
