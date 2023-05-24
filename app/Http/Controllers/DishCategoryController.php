<?php

namespace App\Http\Controllers;

use App\Models\DishCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class DishCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $categories = DishCategory::all();

        return view('admin.dishcategory.index', ["categories"=>$categories]);
    }

    public function add(Request $req){
        if($req->mode == 'update'){
            $category = DishCategory::find($req->id);
            $data = [
                "title" => "Update Category",
            ];
            return view('admin.dishcategory.add',compact('data','category'));
        }elseif($req->mode == 'add'){
            $category =[];
            $data = [
                "title" => "Add New Category",
            ];
            return view('admin.dishcategory.add',compact('data','category'));
        }else{
            return view('admin.dishcategory.index');
        }
    }

    public function create(Request $request){
        if($request->id){
            $request->validate([
                "name"=>"required",
                'image'=>'mimes:jpg,png,jpg|max:5048',
            ]);
        }else{
            $request->validate([
                "name"=>"required",
                'image'=>'required|mimes:jpg,png,jpg|max:5048',
            ]);
        }
        if($request->file('image')){
            if($request->id){
                $grab_data = DishCategory::find($request->id);//grab data'
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
            $test=$request->file('image')->guessExtension();//get extention
            $type=$request->file('image')->getMimeType();//get type
            $newImageName = time().'.'.$request->image->extension();
            $result=  $request->image->move(public_path('images'),$newImageName);

        }else{
            $old_data = DishCategory::find($request->id);
            $newImageName = $old_data->image;
        }
        if($request->id){
            DishCategory::where('id',$request->id)->update([
                "name"=>$request->get("name"),
                'image' => $newImageName,
            ]);
            return Response()->json([
                'status' => 200,
                'message' => 'Dish Category Updated Successfully.',
            ]);
        }else{
            DishCategory::create([
                "name"=>$request->get("name"),
                'image' => $newImageName,
            ]);
            return Response()->json([
                'status' => 200,
                'message' => 'Dish Category Added Successfully.',
            ]);
        }
        
    }
    public function delete(Request $req){
        if($req->ajax()){
            // delete file if exist
            $grab_data = DishCategory::find($req->id);//grab data'
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


            $DishCategory = DishCategory::destroy($req->id);
            return Response()->json([
                'status' => 200,
                'message' => 'DishCategory Deleted Successfully',
            ]);
        }
    }
}
