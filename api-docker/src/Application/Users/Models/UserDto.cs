using Application.Common.Mappings;

using Microsoft.AspNetCore.Identity;

using System;
using System.Collections.Generic;
using System.Text;

namespace Application.Users.Models
{
    public class UserDto : IMapFrom<IdentityUser>
    {

    }
}
