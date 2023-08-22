<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $contacts = Contact::all();

        return view('admin.contact.index', compact('contacts'));
    }

    public function single($id){
        $contact = Contact::find($id);
        $contact->seen = true;

        $contact->save();

        return view('admin.contact.single', compact('contact'));
    }
    public function delete(Request $req){
        if($req->ajax()){
            $booking = Contact::find($req->id);
            $booking->delete();
            return Response()->json([
                'status' => 200,
                'message' => 'File Deleted Successfully',
            ]);
        }
    }

}
