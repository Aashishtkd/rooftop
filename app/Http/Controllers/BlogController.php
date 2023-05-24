<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\File; 
use Yajra\Datatables\Datatables;
use Auth;

class BlogController extends Controller
{
    public function index()
    {
        return view('admin.blogs.index');
    }
    public function loadtable(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::with('admin')->latest()->get();
            return Datatables::of($data)
                ->editColumn('title', function ($row) {
                    $title = substr($row->title,0,100).'...';
                    return $title;
                })
                ->addIndexColumn()
                ->addColumn('admin', function($row){
                    $admin = $row->admin->name;
                    return $admin;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('admin.blog.form' ,['mode'=>'update','id'=>$row->id]).'" class="edit btn btn-success btn-sm">Edit</a>
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm btnDelete" >Delete</a>';
                    return $btn;
                    
                })
                ->rawColumns(['title','admin','action'])
                ->make(true);
        }
    }
    public function form(Request $req)
    {
        if($req->mode == 'update'){
            $article = Blog::find($req->id);
            $data = [
                "title" => "Update Article",
            ];
            return view('admin.blogs.form',compact('data','article'));
        }elseif($req->mode == 'add'){
            $article =[];
            $data = [
                "title" => "Add New Article",
            ];
            return view('admin.blogs.form',compact('data','article'));
            return view('admin.blogs.form');
        }else{
            return view('admin.blogs.index');
        }
        
    }
    
    public function update(Request $req)
    {
            $userId = Auth::id();
            if($req->id){
                $req->validate([
                    'title'=>'required',
                    'content'=>'required',
                    'author'=>'required',
                ]); 
            }else{
                $req->validate([
                    'title'=>'required',
                    'content'=>'required',
                    'author'=>'required',
                    'image'=>'required|mimes:jpg,png,jpg|max:5048',
                ]);
            }
            if($req->file('image')){
                // delete old file
                if($req->id){
                $grab_data = Blog::find($req->id);//grab data'
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
                $old_data = Blog::find($req->id);
                $newImageName = $old_data->image;
            }
            if($req->id){
                if($req->ajax()){

                    $blog = Blog::where('id',$req->id)->update([
                        'title' => $req->input('title'),
                        'content' => $req->input('content'),
                        'author' => $req->input('author'),
                        'image' => $newImageName,
                        'addedBy' => $userId ,
                    ]);
                    return Response()->json([
                        'status' => 200,
                        'message' => 'Blog Updated Successfully.',
                    ]);
                }
            }else{
                if($req->ajax()){
                    $blog = Blog::create([
                        'title' => $req->input('title'),
                        'content' => $req->input('content'),
                        'author' => $req->input('author'),
                        'image' => $newImageName,
                        'addedBy' => $userId ,
                    ]);
                    return Response()->json([
                        'status' => 200,
                        'message' => 'Blog Added Successfully.',
                    ]);
                }
            }

    }
    public function destroy(Request $req){
        if($req->ajax()){
            // delete file if exist
            $grab_data = Blog::find($req->id);//grab data'
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


            $blog = Blog::destroy($req->id);
            return Response()->json([
                'status' => 200,
                'message' => 'Blog Deleted Successfully',
            ]);
        }
    }


}
