<?php

namespace App\Providers;

use App\Repositories\Contracts\HotelRepositoryInterface;
use App\Repositories\Contracts\RoomRepositoryInterface;
use App\Repositories\Contracts\SearchRepositoryInterface;
use App\Repositories\Eloquent\HotelRepository;
use App\Repositories\Eloquent\RoomRepository;
use App\Repositories\Eloquent\SearchRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HotelRepositoryInterface::class, HotelRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(SearchRepositoryInterface::class, SearchRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
