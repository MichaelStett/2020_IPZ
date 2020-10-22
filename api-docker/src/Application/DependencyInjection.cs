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
using Application.Common.Interfaces;
using Application.Common.Behaviours;
using FluentValidation;

namespace Application
{
    public static class DependencyInjection
    {
        public static void AddApplication(this IServiceCollection services)
        {
            services.AddAutoMapper(Assembly.GetExecutingAssembly());
            services.AddMediatR(Assembly.GetExecutingAssembly());
            services.AddValidatorsFromAssembly(Assembly.GetExecutingAssembly());

            services.AddTransient(typeof(IPipelineBehavior<,>), typeof(ValidationBehaviour<,>));
            services.AddTransient(typeof(IPipelineBehavior<,>), typeof(LoggingBehaviour<,>));

            services.AddTransient<IOpenWeatherClient, OpenWeatherClient>();

            var sp = services.BuildServiceProvider();
            var settings = sp.GetService<IOptions<OpenWeatherSettings>>();

            OpenWeatherClient.SetApiCredentials(settings.Value.ApiKey);
        }
    }
}
