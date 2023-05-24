<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\File; 
use Yajra\Datatables\Datatables;
use Auth;

class OtherController extends Controller
{
    public function tindex()
    {
        return view('admin.others.tindex');
    }
    public function tloadtable(Request $request)
    {
        if ($request->ajax()) {
            $data = Testimonial::with('admin')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('admin', function($row){
                    $admin = $row->admin->name;
                    return $admin;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('admin.others.tform' ,['mode'=>'update','id'=>$row->id]).'" class="edit btn btn-success btn-sm">Edit</a>
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm btnDelete" >Delete</a>';
                    return $btn;
                    
                })
                ->rawColumns(['admin','action'])
                ->make(true);
        }
    }
    public function tform(Request $req)
    {
        if($req->mode == 'update'){
            $testi = Testimonial::find($req->id);
            $data = [
                "title" => "Update Testimonial",
            ];
            return view('admin.others.tform',compact('data','testi'));
        }elseif($req->mode == 'add'){
            $testi =[];
            $data = [
                "title" => "Add New Testimonial",
            ];
            return view('admin.others.tform',compact('data','testi'));
            return view('admin.others.tform');
        }else{
            return view('admin.others.tindex');
        }
        
    }
    
    public function tupdate(Request $req)
    {
            $userId = Auth::id();
            if($req->id){
                $req->validate([
                    'content'=>'required',
                    'author'=>'required',
                ]); 
            }else{
                $req->validate([
                    'content'=>'required',
                    'author'=>'required',
                    'image'=>'required|mimes:jpg,png,jpg|max:5048',
                ]);
            }
            if($req->file('image')){
                // delete old file
                if($req->id){
                $grab_data = Testimonial::find($req->id);//grab data'
                    $old_img = $grab_data->image;
                    if(File::exists(public_path('images/'.$old_img))){
                        File::delete(public_path('images/'.$old_img));
                    }else{
                        return Response()->json([
                            'status' => 400,
                            'message' => 'File not exist.',
                        ]);
                    }
                }
                $test=$req->file('image')->guessExtension();//get extention
                $type=$req->file('image')->getMimeType();//get type
        
                $newImageName = time().'.'.$req->image->extension();
                $result=  $req->image->move(public_path('images'),$newImageName);
            }else{
                $old_data = Testimonial::find($req->id);
                $newImageName = $old_data->image;
            }
            if($req->id){
                if($req->ajax()){

                    $testi= Testimonial::where('id',$req->id)->update([
                        'content' => $req->input('content'),
                        'author' => $req->input('author'),
                        'image' => $newImageName,
                        'addedBy' => $userId ,
                    ]);
                    return Response()->json([
                        'status' => 200,
                        'message' => 'Testimonial Updated Successfully.',
                    ]);
                }
            }else{
                if($req->ajax()){
                    $testi= Testimonial::create([
                        'content' => $req->input('content'),
                        'author' => $req->input('author'),
                        'image' => $newImageName,
                        'addedBy' => $userId ,
                    ]);
                    return Response()->json([
                        'status' => 200,
                        'message' => 'Testimonial Added Successfully.',
                    ]);
                }
            }

    }
    public function tdestroy(Request $req){
        if($req->ajax()){
            // delete file if exist
            $grab_data = Testimonial::find($req->id);//grab data'
            $old_img = $grab_data->image;
            
            if(File::exists(public_path('images/'.$old_img))){
                File::delete(public_path('images/'.$old_img));
                /*
                    Delete Multiple File like this way
                    Storage::delete(['upload/test.png', 'upload/test2.png']);
                */
            }else{
                return Response()->json([
                    'status' => 400,
                    'message' => 'File not exist.',
                ]);
            }
            // end delete file


            $testi= Testimonial::destroy($req->id);
            return Response()->json([
                'status' => 200,
                'message' => 'Testimonial Deleted Successfully',
            ]);
        }
    }


}
