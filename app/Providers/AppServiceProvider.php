<?php

namespace App\Providers;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

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
        view()->composer('*', function($view){
            $sessionId = Session::get('device_id');
            $totalcart  = Cart::where('device_id', $sessionId )->sum('quantity');
            $view->with('totalcart', $totalcart);
        });
    }
}
