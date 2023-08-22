<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $orders = Order::all();

        return view('admin.order.index', compact('orders'));
    }

    public function single($id){
        $order = Order::with('listitem')->find($id);
        $orderitems = OrderItem::with('dishs')->where('order_id',$id)->get();

        return view('admin.order.single', compact('order','orderitems'));
    }

    public function complete($id){
        $order = Order::find($id);

        $order->completed = true;
        $order->save();

        return redirect()->route('admin.order.index');
    }

    public function delete(Request $req){
        if($req->ajax()){
            $booking = Order::find($req->id);
            $booking->delete();
            return Response()->json([
                'status' => 200,
                'message' => 'File Deleted Successfully',
            ]);
        }
    }
}
