<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index(Request $req)
    {
        if($req->mode =='Video'){
            $videos = Gallery::where('type','video')->get();
            return view('admin.gallery.index',compact('videos'),['mode'=>'Video']);
        }else{
            $photos = Gallery::where('type','photo')->get();
            return view('admin.gallery.index',compact('photos'),['mode'=>'Photo']);
        
        }
    }
       
    public function update(Request $req){
        if($req->type == 'video'){
            $req->validate([
                'file'=>'required',
                'title'=>'required',
            ]); 
            $link = explode("/",$req->file);
            if($req->ajax()){
                $gallery = Gallery::create([
                    'title' => $req->title,
                    'file' => $link[3],
                    'type' => 'video',
                ]);
                return Response()->json([
                    'status' => 200,
                    'message' => 'Video Added Successfully.',
                ]);
            }
        }else{
            $req->validate([
                'file'=>'required|mimes:jpg,png,jpg|max:5048',
            ]); 

            $test=$req->file('file')->guessExtension();//get extention
            $type=$req->file('file')->getMimeType();//get type
    
            $newImageName = time().'_gallery'.$req->file->extension();
            $result=  $req->file->move(public_path('gallery'),$newImageName);
            
            if($req->ajax()){
                $gallery = Gallery::create([
                    'file' => $newImageName,
                    'type' => 'photo',
                ]);
                return Response()->json([
                    'status' => 200,
                    'message' => 'Photo Added Successfully.',
                ]);
            }
        }

    }
    public function destroy(Request $req){
        if($req->ajax()){
            // delete file if exist
            $grab_data = Gallery::find($req->id);//grab data'
            $old_img = $grab_data->file;
            $type = $grab_data->type;
            if($type == 'photo'){
                if(File::exists(public_path('gallery/'.$old_img))){
                    File::delete(public_path('gallery/'.$old_img));
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
            }
            $gallery = Gallery::destroy($req->id);
            return Response()->json([
                'status' => 200,
                'message' => 'File Deleted Successfully',
            ]);
        }
    }
}
