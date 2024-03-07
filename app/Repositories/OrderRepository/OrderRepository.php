<?php

namespace App\Repositories\OrderRepository;

use App\Models\Order;
use App\Interfaces\OrderInterface\OrderRepositoryInterface;
class OrderRepository implements OrderRepositoryInterface {
    public function index(){
        return Order::all();
    }
    public function getById($id){
       return Order::findOrFail($id);
    }
    public function store(array $details){
       return Order::create($details);
    }
    public function update(array $details, $id){
        return Order::whereId($id)->update($details);
    }
}