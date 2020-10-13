using Domain.Interfaces;

using MediatR;

using Microsoft.AspNetCore.Identity;

using System;
using System.Collections.Generic;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace Application.Accounts.Commands.DeleteAccountCommand
{
    public class DeleteAccountCommand : IRequest<bool>
    {
        public string Id { get; set; }

        public class DeleteAccountCommandHandler : IRequestHandler<DeleteAccountCommand, bool>
        {
            private readonly UserManager<IdentityUser> _userManager;
            private readonly SignInManager<IdentityUser> _signInManager;

            public DeleteAccountCommandHandler(
                UserManager<IdentityUser> userManager, SignInManager<IdentityUser> signInManager)
                => (_userManager, _signInManager) = (userManager, signInManager);

            public async Task<bool> Handle(DeleteAccountCommand request, CancellationToken cancellationToken)
            {
                var user = await _userManager.FindByIdAsync(request.Id);

                if (user == null)
                    return false;

                await _userManager.DeleteAsync(user);

                return true;
            }
        }
    }
}
