<?php

namespace App\Repositories\ProductRepository;
use App\Interfaces\ProductInterface\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface{    
    /**
     * get All Product
     *
     * @return void
     */
    public function index(){
       return Product::all();
    }    
    /**
     * get By Id Product
     *
     * @param  mixed $id
     * @return void
     */
    public function getById($id){
       return Product::findOrFail($id);
    }    
    /**
     * store Product
     *
     * @param  mixed $details
     * @return void
     */
    public function store(array $details){
      return Product::create($details);
    }    
    /**
     * update Product
     *
     * @param  mixed $details
     * @param  mixed $id
     * @return void
     */
    public function update(array $details, $id){
      return Product::whereId($id)->update($details);
    }    
    /**
     * destory Product
     *
     * @param  mixed $id
     * @return void
     */
    public function destory($id){
        return Product::destroy($id);
    }
}