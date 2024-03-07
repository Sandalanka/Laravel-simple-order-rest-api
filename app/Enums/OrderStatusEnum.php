<?php

namespace App\Enums;

enum OrdersStatusEnum:string {
    
    case Pending = 'pending';
    case Active = 'active';
    case Inactive = 'inactive';
    case Rejected = 'rejected';
}