<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Booking;
use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\Testimonial;
use App\Models\Order;
use App\Models\Gallery;
use App\Models\OrderItem;
use App\Models\Blog;
use App\Models\Cart;
use DB;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        $feature = Dish::where('feature', 'true')->limit(4)->get();
        $categories = DishCategory::with('dishes')->limit(6)->get();
        $testimonial = Testimonial::all();
        return view('front.index', compact('categories','feature','testimonial'));
    }
    public function book(){
        return view('front.book');
    }

    public function menu(){
        $categories = DishCategory::with('dishes')->get();
        return view('front.menu', compact('categories'));
    }
    public function blog(){
        $blogs = Blog::all();
        return view('front.blog', compact('blogs'));
    }
    public function mygallery(){
        $gallery = Gallery::all();
        return view('front.gallery', compact('gallery'));
    }
    public function blogDetails(Request $req){
        $blogs = Blog::select('*')->limit(4)->get();
        $blog = Blog::find($req->id);
        return view('front.single_blog', compact('blog','blogs'));
    }
    public function order(){
        $categories = DishCategory::all();

        return view('front.order', compact('categories'));
    }
    public function cart(Request $request){
        $deviseId = $request->session()->get('device_id');
        if(isset($deviseId)){
            $items = Cart::with('dishes')->where('device_id',$deviseId)->get();
            $totalSum = DB::table('carts')
                            ->join('dishes', 'carts.dish', '=', 'dishes.id')
                            ->sum(DB::raw('dishes.price * carts.quantity'));
        }else{
            $items = null;
        }
        return view('front.cart',compact('items','totalSum'));
    }

    public function incrementCart(Request $request){
        $cart =  Cart::find($request->id);
        if($request->ajax()){
            if(isset($cart)){
                $quantity = $cart->quantity + 1;
                $Cart = Cart::where('id',$cart->id)->update([
                    'quantity' => $quantity
                ]);
            }
        }
    }
    public function decrementCart(Request $request){
        $cart =  Cart::find($request->id);
        if($request->ajax()){
            if(isset($cart)){
                if($cart->quantity > 1){
                    $quantity = $cart->quantity - 1;
                }else{
                    $quantity = 1;
                }
                $Cart = Cart::where('id',$cart->id)->update([
                    'quantity' => $quantity
                ]);
            }
        }
        
    }
    public function deleteCart(Request $request){
        $cart =  Cart::find($request->id);
        if($request->ajax()){
            if(isset($cart)){
                Cart::destroy($request->id);
            }
        }
        
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

        return view('front.ordercompleted', compact("order"));
    }

    public function contact(){
        return view('front.contact');
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

        return view('front.contactsuccess', compact("contact"));
    }
    public function createbookings(Request $request){
        $request->validate([
            "name"=>"required",
            "phone"=>"required",
            "person"=>"required",
            "date"=>"required",
            "time"=>"required",
        ]);

        $booking = Booking::create([
            "name"=>$request->get("name"),
            "phone"=>$request->get("phone"),
            "person"=>$request->get("person"),
            "date"=>$request->get("date"),
            "completed"=>"false",
            "time"=>$request->get("time"),
        ]);
        return redirect()->route('bookingsuccess');
    }
    
    public function about(){
        return view('front.about');
    }
    public function bookingsuccess(){
        return view('front.bookingsuccess');
    }
    public function contactsuccess(){
        return view('front.contactsuccess');
    }
    public function addNewCart(Request $request){
        if($request->ajax()){
            $grab_data = Cart::where('device_id', $request->userAgent)->where('dish',$request->id)->first();
            // Set the session expiration time to one day
            $request->session()->put('device_id', $request->userAgent);
            if(isset($grab_data->id)){
                $quantity = $grab_data->quantity + 1;
                $Cart = Cart::where('id',$grab_data->id)->update([
                    'quantity' => $quantity
                ]);
                $totalcart  = Cart::where('device_id', $request->userAgent )->sum('quantity');
                return Response()->json([
                    'status' => 200,
                    'totalcart' => $totalcart ,
                    'message' => 'Cart Updated Successfully.',
                ]);
            }else{
                $Cart = Cart::create([
                    'dish' => $request->id,
                    'quantity' => 1,
                    'device_id' => $request->userAgent,
                ]);
                $totalcart  = Cart::where('device_id', $request->userAgent )->sum('quantity');
                return Response()->json([
                    'status' => 200,
                    'totalcart' => $totalcart ,
                    'message' => 'Dish Added To Cart Successfully.',
                ]);
            }
        }
        return view('front.contactsuccess');
    }
}
