<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(){
        $bookings = Booking::all();

        return view('admin.bookings.index', compact('bookings'));
    }
    public function changestatus($id){
        $booking = Booking::find($id);
        if($booking->completed  == "true"){
            $booking->completed = "false";
        }else{
            $booking->completed = "true";
        }
        $booking->save();
        return redirect()->route('admin.booking.index');
    }
    public function destroy(Request $req){
        if($req->ajax()){
            $booking = Booking::find($req->id);
            $booking->delete();
            return Response()->json([
                'status' => 200,
                'message' => 'File Deleted Successfully',
            ]);
        }
    }
}
