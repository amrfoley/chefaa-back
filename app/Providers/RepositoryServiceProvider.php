<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\IRepository;
use App\Http\Repositories\IProductRepository;
use App\Http\Repositories\IPharmacyRepository;
use App\Http\Repositories\Eloquent\BaseRepository;
use App\Http\Repositories\Eloquent\ProductRepository;
use App\Http\Repositories\Eloquent\PharmachyRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IRepository::class, BaseRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(IPharmacyRepository::class, PharmachyRepository::class);
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
