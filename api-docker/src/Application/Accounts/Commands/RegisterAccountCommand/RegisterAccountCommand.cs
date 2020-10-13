using MediatR;

using Microsoft.AspNetCore.Identity;

using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace Application.Accounts.Commands.RegisterAccountCommand
{
    public class RegisterAccountCommand : IRequest<string>
    {
        public string UserName { get; set; }
        public string Email { get; set; }
        public string Password { get; set; }

        public class RegisterAccountCommandHandler : IRequestHandler<RegisterAccountCommand, string>
        {
            private readonly UserManager<IdentityUser> _userManager;
            private readonly SignInManager<IdentityUser> _signInManager;

            public RegisterAccountCommandHandler(
                UserManager<IdentityUser> userManager, SignInManager<IdentityUser> signInManager)
                => (_userManager, _signInManager) = (userManager, signInManager);

            public async Task<string> Handle(RegisterAccountCommand request, CancellationToken cancellationToken)
            {
                var newUser = new IdentityUser { UserName = request.UserName, Email = request.Email };

                var result = await _userManager.CreateAsync(newUser, request.Password);

                if (result.Succeeded)
                {
                    await _signInManager.SignInAsync(newUser, isPersistent: false);

                    return string.Empty;
                }
                else
                {
                    throw new Exception(string.Join(Environment.NewLine, result.Errors.ToList()));
                }
            }
        }
    }
}
