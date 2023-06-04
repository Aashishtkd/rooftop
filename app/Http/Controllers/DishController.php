<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\DishCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class DishController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $dishes = Dish::all();
        return view('admin.dish.index', compact('dishes','dishes'));
    }

    public function add(Request $req){
        $categories = DishCategory::all();
        if($req->mode == 'update'){
            $dish = Dish::find($req->id);
            $data = [
                "title" => "Update Dish",
            ];
            return view('admin.dish.add',compact('data','dish','categories'));
        }elseif($req->mode == 'add'){
            $dish =[];
            $data = [
                "title" => "Add New Dish",
            ];
            return view('admin.dish.add',compact('data','dish','categories'));
        }else{
            return view('admin.dish.index');
        }
    }

    public function create(Request $request){
        if($request->id){
            $request->validate([
                "name"=>"required",
                "price"=>"required|numeric",
                'image'=>'mimes:jpg,png,jpg|max:5048',
                "category"=>"required",
                "feature"=>"required",
                "discount"=>"required"
            ]);
        }else{
            $request->validate([
                "name"=>"required",
                "price"=>"required|numeric",
                'image'=>'required|mimes:jpg,png,jpg|max:5048',
                "category"=>"required",
                "feature"=>"required"
            ]);
        }

        if($request->file('image')){
            if($request->id){
                $grab_data = Dish::find($request->id);//grab data'
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
            $old_data = Dish::find($request->id);
            $newImageName = $old_data->image;
        }
        if($request->id){
            Dish::where('id',$request->id)->update([
                "name"=>$request->get("name"),
                "price"=>$request->get("price"),
                "feature"=>$request->get("feature"),
                "discount"=>$request->get("discount"),
                "dish_category_id"=>$request->get("category"),
                'image' => $newImageName,
            ]);
            return Response()->json([
                'status' => 200,
                'message' => 'Dish Updated Successfully.',
            ]);
        }else{
            Dish::create([
                "name"=>$request->get("name"),
                "price"=>$request->get("price"),
                "feature"=>$request->get("feature"),
                "discount"=>$request->get("discount"),
                "dish_category_id"=>$request->get("category"),
                'image' => $newImageName,
            ]);
            return Response()->json([
                'status' => 200,
                'message' => 'Dish Added Successfully.',
            ]);
        }
    }

    public function delete(Request $req){
        if($req->ajax()){
            // delete file if exist
            $grab_data = Dish::find($req->id);//grab data'
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


            $Dish = Dish::destroy($req->id);
            return Response()->json([
                'status' => 200,
                'message' => 'Dish Deleted Successfully',
            ]);
        }
    }

}
