<?php

namespace App\Enums;

enum OrderStatusEnum:string {
    
    case Pending = 'pending';
    case Active = 'active';
    case Inactive = 'inactive';
    case Rejected = 'rejected';
}