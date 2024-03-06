<?php

namespace App\Http\Controllers;

use App\Classes\ApiCatchError;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Interfaces\ProductInterface\ProductRepositoryInterface;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends BaseController
{   
    private ProductRepositoryInterface $productRepositoryInterface;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->middleware('permission:create-product', ['only' => ['store']]);
        $this->middleware('permission:edit-product', ['only' => ['update']]);
        $this->middleware('permission:delete-product', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->productRepositoryInterface->index();
        return $this->sendResponse( ProductResource::collection($data),'',200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {   $productDetails =[
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ];
        DB::beginTransaction();
        try{
            $data = $this->productRepositoryInterface->store($productDetails);
            DB::commit();
            return $this->sendResponse( new ProductResource($data),'Product Created Successful',201);
        }catch(\Exception $ex){
           return ApiCatchError::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show( $product)
    {
        $data = $this->productRepositoryInterface->getById($product);
        return $this->sendResponse( new ProductResource($data),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request,  $product)
    {
        $productDetails =[
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ];
        DB::beginTransaction();
        try{
            $data = $this->productRepositoryInterface->update($productDetails,$product);
            DB::commit();
            return $this->sendResponse( 'Product Updated','',202);
        }catch(\Exception $ex){
           return ApiCatchError::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy( $product)
    {
        $data = $this->productRepositoryInterface->destory($product);
        return $this->sendResponse( 'Product Detated','',200);
    }
}
