<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\IRepository;
use App\Repositories\IProductRepository;
use App\Repositories\IPharmacyRepository;
use App\Repositories\IPharmacyProductRepository;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\PharmachyRepository;
use App\Repositories\Eloquent\PharmachyProductRepository;

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
        $this->app->bind(IPharmacyProductRepository::class, PharmachyProductRepository::class);
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
