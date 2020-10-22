using System;
using System.Collections.Generic;
using System.Text;

namespace Domain.Entities
{
    public class Log
    {
        public Guid Id { get; set; }
        public DateTime Time { get; set; }
        public string Content { get; set; }
    }
}
