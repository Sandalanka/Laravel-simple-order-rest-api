<?php

namespace App\Interfaces\OrderDetailsInterface;

interface OrderDetailsRepositoryInterface{
   
    public function store(array $details);
}