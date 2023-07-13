<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;
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
    public function getcheckoutorder(Request $request){
        return redirect()->route('cart');
    }
    public function checkoutorder(Request $request){
        $items = null;
        if ($request->isMethod('post')){
            $deviseId = $request->deviseId;
            $total = $request->total;
            $name = $request->name;
            $location = $request->location;
            $phone = $request->phone;
            // get cart items
            $items = Cart::with('dishes')->where('device_id',$deviseId)->get();
        }
        // check old data exist or not
        $old_order = OrderItem::where("user_id",$deviseId)->where("order_id",null)->get();
       
        if(count($items)>0){
            if(count($old_order) != count($items)){
                $dataDelete = OrderItem::where("user_id",$deviseId)->where("order_id",null)->delete();
                foreach($items as $item){
                    $dish = Dish::find($item->dish);
                    $amt = $dish->price - $dish->discount;
                    $order = OrderItem::insert([
                        "dish"=>$dish->id,
                        "quantity"=>$item->quantity,
                        "amt"=>$amt,
                        "user_id"=>$deviseId,
                        "order_id"=>null,
                    ]);
                }
            }
        }else{
            $categories = DishCategory::with('dishes')->get();
            return view('front.menu', compact('categories'));
        }
        $orderSum = OrderItem::with("dishs")->where("user_id", $deviseId)->where("order_id",null)->sum('amt');
        $orgeritem = OrderItem::with("dishs")->where("user_id", $deviseId)->where("order_id",null)->get();
        return view('front.order', compact('orgeritem','orderSum','location','name','phone'));
    }
    public function confirmorder(Request $request){
        $deviceId = $request->deviceId;
        $name = $request->name;
        $location = $request->location;
        $phone = $request->phone;
        $orderID = Order::insertGetId([
            "name"=>$name,
            "location"=>$location,
            "phone"=>$phone,
            "status"=>"pending",
            "created_at"=>Carbon::now(),
        ]);
        if(isset($orderID)){
            $old_order = OrderItem::where("user_id",$deviceId)->get();
            $delete_cart = Cart::where("device_id",$deviceId)->delete();
            foreach($old_order as $item){
                $order = OrderItem::where("id", $item->id)->update([
                    "order_id"=>$orderID,
                ]);
            }
            // send mail
            $settings = Setting::first(); 
            $user['to'] =  $settings->email ;
            $data = [
                'name' => $name,
                'phone' => $phone,
                "status"=>"pending",
                "location"=>$location,
                'subject' => 'ROOF-TOP Order Mail.',
                'body' => "Please check order i have placed an order.",
            ];
            Mail::send('front.ordermail',array('data' => $data),function($messages) use ($user){
                $messages->to($user['to']);
                $messages->subject('ROOF-TOP Order Mail.');
            });
            return redirect()->route('ordersuccess');
        }
    }
    public function cart(Request $request){
        $deviseId = $request->session()->get('device_id');
        $totalSum = 0;
        if(isset($deviseId)){
            $items = Cart::with('dishes')->where('device_id',$deviseId)->get();
            $totalSum = DB::table('carts')
                            ->where('device_id',$deviseId)
                            ->join('dishes', 'carts.dish', '=', 'dishes.id')
                            ->sum(DB::raw('dishes.price * carts.quantity'));
        }else{
            $items = null;
        }
        return view('front.cart',compact('items','totalSum','deviseId'));
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
        $settings = Setting::first(); 
        $user['to'] =  $settings->email ;
        $data = [
            'name' => $request->get("name"),
            'phone' => $request->get("phone"),
            'subject' => 'ROOF-TOP Contact Mail.',
            'body' => $request->get("message"),
        ];
        Mail::send('front.bookingmail',array('data' => $data),function($messages) use ($user){
            $messages->to($user['to']);
            $messages->subject('ROOF-TOP Contact Mail.');
        });


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
        // send mail
        $settings = Setting::first(); 
        $user['to'] =  $settings->email ;
        $data = [
            "name"=>$request->get("name"),
            "phone"=>$request->get("phone"),
            "person"=>$request->get("person"),
            "date"=>$request->get("date"),
            "time"=>$request->get("time"),
            'subject' => 'ROOF-TOP Table Booking Mail.',
            'body' => "I have Booked a table please check.",
        ];
        Mail::send('front.tablebookingmail',array('data' => $data),function($messages) use ($user){
            $messages->to($user['to']);
            $messages->subject('ROOF-TOP Table Booking Mail.');
        });
        return redirect()->route('bookingsuccess');
    }
    
    public function about(){
        return view('front.about');
    }
    public function bookingsuccess(){
        return view('front.bookingsuccess');
    }
    public function ordersuccess(){
        return view('front.ordersuccess');
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
