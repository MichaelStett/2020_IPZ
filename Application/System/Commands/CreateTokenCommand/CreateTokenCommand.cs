using System;
using System.Collections.Generic;
using System.IdentityModel.Tokens.Jwt;
using System.Security.Claims;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

using MediatR;

using Microsoft.IdentityModel.Tokens;

namespace Application.System.Commands.CreateTokenCommand
{
    public class CreateTokenCommand : IRequest<string>
    {
        public string Username { get; set; }
        public string Password { get; set; }
        public int ExpireMinutes { get; set; } = 20;

        public class CreateTokenCommandHandler : IRequestHandler<CreateTokenCommand, string>
        {
            public async Task<string> Handle(CreateTokenCommand request, CancellationToken cancellationToken)
            {
                var securityKey = new SymmetricSecurityKey(
                    Encoding.UTF8.GetBytes(TokenGlobal.SECRET));

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

                    Expires = now.AddMinutes(Convert.ToInt32(request.ExpireMinutes)),

                    SigningCredentials = credentials
                };

                var tokenHandler = new JwtSecurityTokenHandler();

                var stoken = tokenHandler.CreateToken(tokenDescriptor);
                var token = tokenHandler.WriteToken(stoken);

                return token;
            }
        }

    }
}
