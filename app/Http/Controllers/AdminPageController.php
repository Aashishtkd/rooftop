<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $dish = Dish::all()->count();
        $category = DishCategory::all()->count();
        $message = Contact::all()->count();
        $order = Order::all()->count();

        return view('admin.index', compact(["dish", "category", "message", "order"]));
    }
}
