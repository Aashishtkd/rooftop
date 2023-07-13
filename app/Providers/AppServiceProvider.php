<?php

namespace App\Providers;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Setting;

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
            $settings = Setting::first(); 
            $totalcart  = Cart::where('device_id', $sessionId )->sum('quantity');
            $settings = Setting::first(); 
            $view->with([
                'totalcart' => $totalcart,
                'settings' => $settings,
            ]);
        });
    }
}
