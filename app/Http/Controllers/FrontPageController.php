<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function index(){
        return view('frontend.index');
    }

    public function menu(){
        $categories = DishCategory::all();

        return view('frontend.menu', compact('categories'));
    }

    public function order(){
        $categories = DishCategory::all();

        return view('frontend.order', compact('categories'));
    }

    public function single(Request $request){
        return Dish::find($request->get('id'));
    }

    public function completeOrder(Request $request){

        $request->validate([
            "name"=>"required",
            "phone"=>"required",
            "location"=>"required",
            "order"=>"required"
        ]);

        $order = Order::create([
            "name"=>$request->get("name"),
            "phone"=>$request->get("phone"),
            "location"=>$request->get("location"),
        ]);

        $dishes = $request->get("order");

        for ($i = 0; $i < count($dishes); $i++) {
            OrderItem::create([
                "dish_id"=>$dishes[$i],
                "order_id"=>$order->id
            ]);
        }

        return view('frontend.ordercompleted', compact("order"));
    }

    public function contact(){
        return view('frontend.contact');
    }

    public function createContact(Request $request){
        $request->validate([
            "name"=>"required",
            "phone"=>"required",
            "message"=>"required"
        ]);

        $contact = Contact::create([
            "name"=>$request->get("name"),
            "phone"=>$request->get("phone"),
            "message"=>$request->get("message"),
            "seen"=>false
        ]);

        return view('frontend.contactsuccess', compact("contact"));
    }

    public function about(){
        return view('frontend.about');
    }
}
