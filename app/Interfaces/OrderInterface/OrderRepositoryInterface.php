<?php

namespace App\Interfaces\OrderInterface;

interface OrderRepositoryInterface{
    public function index();
    public function getById($id);
    public function store(array $details);
    public function update(array $details, $id);
}