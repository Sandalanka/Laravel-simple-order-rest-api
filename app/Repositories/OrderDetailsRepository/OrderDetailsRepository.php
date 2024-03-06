<?php

namespace App\Repositories\OrderDetailsRepository;

use App\Interfaces\OrderDetailsInterface\OrderDetailsRepositoryInterface;
use App\Models\OrderDetails;

class OrderDetailsRepository implements OrderDetailsRepositoryInterface{
    
    public function store(array $details){
        return OrderDetails::create($details);
    }
}