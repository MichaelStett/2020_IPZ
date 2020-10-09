using System;
using System.Collections.Generic;
using System.Text;

using Domain.Interfaces;

using Microsoft.EntityFrameworkCore;

namespace Infrastructure
{
    public class Context : DbContext, IContext
    {

    }
}
