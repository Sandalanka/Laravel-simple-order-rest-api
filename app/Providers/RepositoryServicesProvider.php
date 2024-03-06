<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\UserInterface\UserRepositoryInterface;
use App\Repositories\UserRepository\UserRepository;
use App\Repositories\ProductRepository\ProductRepository;
use App\Interfaces\ProductInterface\ProductRepositoryInterface;
use App\Interfaces\OrderInterface\OrderRepositoryInterface;
use App\Repositories\OrderRepository\OrderRepository;
use App\Interfaces\OrderDetailsInterface\OrderDetailsRepositoryInterface;
use App\Repositories\OrderDetailsRepository\OrderDetailsRepository;
class RepositoryServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);
        $this->app->bind(OrderRepositoryInterface::class,OrderRepository::class);
        $this->app->bind(OrderDetailsRepositoryInterface::class,OrderDetailsRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
