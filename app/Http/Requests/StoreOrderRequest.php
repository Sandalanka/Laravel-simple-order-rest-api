<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest as BaseRequest;

class StoreOrderRequest extends BaseRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_id'=>'required|exists:users,id',
            'total_bill' => 'required',
            'order_details' =>'required|array',
            'order_details.*.product_id' =>'required|exists:products,id',
            'order_details.*.quantity' =>'required|numeric',
            'order_details.*.prices' =>'required|numeric',

        ];
    }
}
