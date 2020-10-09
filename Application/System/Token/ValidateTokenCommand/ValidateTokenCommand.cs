using MediatR;

using Microsoft.IdentityModel.Tokens;

using System;
using System.Collections.Generic;
using System.IdentityModel.Tokens.Jwt;
using System.Security.Claims;
using System.Security.Principal;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace Application.System.Token.ValidateTokenCommand
{
    public class ValidateTokenCommand : IRequest<bool>
    {
        public string Token { get; set; }

        public class ValidateTokenCommandHandler : IRequestHandler<ValidateTokenCommand, bool>
        {
            public async Task<bool> Handle(ValidateTokenCommand request, CancellationToken cancellationToken)
            {
                var tokenHandler = new JwtSecurityTokenHandler();
                var validationParameters = new TokenValidationParameters()
                {
                    ValidateLifetime = true,
                    ValidateAudience = false,
                    ValidateIssuer = false,   
                    ValidIssuer = "",
                    ValidAudience = "",
                    IssuerSigningKey = new SymmetricSecurityKey(Encoding.UTF8.GetBytes(TokenGlobal.SECRET))
                };

                IPrincipal principal = tokenHandler.ValidateToken(request.Token, validationParameters, out SecurityToken validatedToken);

                return true;
            }
        }
    }
}
