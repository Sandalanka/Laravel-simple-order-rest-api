<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseRequest as BaseRequest;

class UpdateOrderRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

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
