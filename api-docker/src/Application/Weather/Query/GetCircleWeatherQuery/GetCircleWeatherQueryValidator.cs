using FluentValidation;

using RestSharp.Extensions;

using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Reflection;
using System.Text;

namespace Application.Weather.Query.GetCircleWeatherQuery
{
    public class GetCircleWeatherQueryValidator : AbstractValidator<GetCircleWeatherQuery>
    {
        public GetCircleWeatherQueryValidator()
        {
            RuleFor(x => x.Latitude)
                .NotNull()
                .InclusiveBetween(
                    GetRangeMinValue("Latitude"),
                    GetRangeMaxValue("Latitude"));

            RuleFor(x => x.Longitude)
                .NotNull()
                .InclusiveBetween(
                    GetRangeMinValue("Longitude"),
                    GetRangeMaxValue("Longitude"));

            RuleFor(x => x.Count)
                .NotNull()
                .GreaterThanOrEqualTo(GetRangeMinValue("Count"))
                .LessThanOrEqualTo(GetRangeMaxValue("Count"));
        }

        private int GetRangeMinValue(string name)
        {
            var attr = typeof(GetCircleWeatherQuery).GetField(name);
            var value = (int)attr.GetAttribute<RangeAttribute>().Minimum;

            return value;
        }

        private int GetRangeMaxValue(string name)
        {
            var attr = typeof(GetCircleWeatherQuery).GetField(name);
            var value = (int)attr.GetAttribute<RangeAttribute>().Maximum;

            return value;
        }
    }
}
