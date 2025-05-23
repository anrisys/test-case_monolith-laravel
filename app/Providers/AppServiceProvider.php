<?php

namespace App\Providers;

use App\Http\Repositories\Contracts\ItemRepositoryInterface;
use App\Http\Repositories\Impl\ItemRepository;
use App\Http\Services\Contracts\ItemServiceInterface;
use App\Http\Services\Impl\ItemService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ItemRepositoryInterface::class, ItemRepository::class);
        $this->app->singleton(ItemServiceInterface::class, ItemService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
