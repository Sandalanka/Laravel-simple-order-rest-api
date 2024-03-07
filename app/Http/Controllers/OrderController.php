<?php

namespace App\Http\Controllers;

use App\Classes\ApiCatchError;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Interfaces\OrderInterface\OrderRepositoryInterface;
use App\Interfaces\OrderDetailsInterface\OrderDetailsRepositoryInterface;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\OrderResource;

class OrderController extends BaseController
{
    private OrderRepositoryInterface $orderRepositoryInterface;
    private OrderDetailsRepositoryInterface $orderDetailsRepositoryInterface;

    public function __construct(
        OrderRepositoryInterface $orderRepositoryInterface,
        OrderDetailsRepositoryInterface $orderDetailsRepositoryInterface)
    {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
        $this->orderDetailsRepositoryInterface = $orderDetailsRepositoryInterface;
        $this->middleware('permission:create-order', ['only' => ['store']]);
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders =$this->orderRepositoryInterface->index();
        return $this->sendResponse(OrderResource::collection($orders),'',200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {   
        $orderData =[
            'customer_id' => $request->customer_id,
            'total_bill'  => $request->total_bill,
        ];
        DB::beginTransaction();
        try{
            $order =$this->orderRepositoryInterface->store($orderData);
            foreach($request->order_details as $details){
                $orderDetails =[
                    'order_id' => $order->id,
                    'product_id' => $details['product_id'],
                    'quantity' => $details['quantity'],
                    'prices' => $details['prices']
                ];
                $this->orderDetailsRepositoryInterface->store($orderDetails);
            }
            DB::commit();
            return $this->sendResponse(new OrderResource($order),'Order created succesful',201);

        }catch(\Exception $ex){
            return ApiCatchError::rollback($ex);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($order)
    {
        $order =$this->orderRepositoryInterface->getById($order);
        return $this->sendResponse(new OrderResource($order),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request,  $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
