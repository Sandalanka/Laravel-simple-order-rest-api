<?php

namespace App\Interfaces\ProductInterface;

interface ProductRepositoryInterface{

    public function index();
    public function getById($id);
    public function store(array $details);
    public function update(array $details, $id);
    public function destory($id);

}