<?php

namespace App\Providers;

use App\Category;
use App\Color;
use App\Observers\CategoryObserver;
use App\Observers\ColorObserver;
use App\Observers\ProductObserver;
use App\Observers\SizeObserver;
use App\Product;
use App\Size;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(\App\Observers\ProductObserver::class);
        Category::observe(\App\Observers\CategoryObserver::class);
        Color::observe(\App\Observers\ColorObserver::class);
        Size::observe(\App\Observers\SizeObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
