<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\ProductCart;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        if (Schema::hasTable('categories')) {
            $data = Category::all();
            view()->share('categories', $data);
            View::composer('*', function ($view) {
                if (auth()->check()) {
                    $cartCount = ProductCart::where('user_id', auth()->user()->id)->count();
                    $view->with('cartCount', $cartCount);
                }
            });
            View::composer('*', function ($view) {
                if (auth()->guard('admin')->user()) {
                    $orderCount = ProductOrder::where('status', 'pending')->count();
                    $view->with('noti', $orderCount);
                }
            });
        }
    }
}
