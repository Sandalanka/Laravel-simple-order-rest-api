<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\OrderStatusEnum;
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'total_bill',
    ];

    // protected $casts = [
    //     'order_status' => OrderStatusEnum::class
    // ];

    public function customer(){
        return $this->belongsTo(User::class);
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetails::class);
    }
}
