using System;
using System.Collections.Generic;
using System.IdentityModel.Tokens.Jwt;
using System.Security.Claims;
using System.Text;
using System.Threading;
using System.Threading.Tasks;


using MediatR;

using Microsoft.IdentityModel.Tokens;
using Microsoft.Extensions.Configuration;


namespace Application.Token.Commands.CreateTokenCommand
{
    public class CreateTokenCommand : IRequest<string>
    {
        public string Username { get; set; }
        public string Password { get; set; }

        public class CreateTokenCommandHandler : IRequestHandler<CreateTokenCommand, string>
        {
            private readonly IConfiguration _configuration;

            public CreateTokenCommandHandler(IConfiguration configuration)
                => (_configuration) = (configuration);

            public async Task<string> Handle(CreateTokenCommand request, CancellationToken cancellationToken)
            {
                var securityKey = new SymmetricSecurityKey(
                    Encoding.UTF8.GetBytes(_configuration["Token:Options:Key"]));

                var credentials = new SigningCredentials(securityKey, SecurityAlgorithms.HmacSha256);

                var now = DateTime.UtcNow;
                var tokenDescriptor = new SecurityTokenDescriptor
                {
                    Issuer = "",
                    Audience = "",
                    Subject = new ClaimsIdentity(new[]
                    {
                        new Claim(ClaimTypes.Name, request.Username)
                    }),

                    Expires = now.AddDays(1),

                    SigningCredentials = credentials
                };

                var tokenHandler = new JwtSecurityTokenHandler();

                var security_token = tokenHandler.CreateToken(tokenDescriptor);
                var access_token = tokenHandler.WriteToken(security_token);

                return access_token;
            }
        }

    }
}
