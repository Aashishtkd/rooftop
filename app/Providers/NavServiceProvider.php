<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Order;
use Illuminate\Support\ServiceProvider;

class NavServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->order_remaining  = Order::where('completed', 0)->count();
        $this->unseen_contact  = Contact::where('seen', 0)->count();

        view()->composer('layouts.admin', function($view) {
            $view->with([
                'order_remaining' => $this->order_remaining,
                'unseen_contact' => $this->unseen_contact,
            ]);
        });
    }
}
