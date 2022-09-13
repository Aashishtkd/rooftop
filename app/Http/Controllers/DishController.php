<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\DishCategory;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $dishes = Dish::all();

        return view('admin.dish.index', ["dishes"=>$dishes]);
    }

    public function add(){
        $categories = DishCategory::all();

        return view('admin.dish.add', ["categories"=>$categories]);
    }

    public function create(Request $request){
        $request->validate([
            "name"=>"required",
            "price"=>"required|numeric",
            "image"=>"required|image"
        ]);

        if($request->hasFile('image')){

            $request->validate([
                'image' => 'image'
            ]);

            // Issue due to storage link, have to change it to storage instead of public
            $image_path = $request->file('image')->store('public');
            $image_path = "storage/".explode('/', $image_path)[1];


            // This line of code is for production, issue in transfering to public/storage folder

            $img_name = explode('/', $image_path)[1];
            rename('../storage/app/public/'.$img_name, '../public/storage/'.$img_name);

        }



        Dish::create([
            "name"=>$request->get("name"),
            "price"=>$request->get("price"),
            "dish_category_id"=>$request->get("category"),
            "image"=>$image_path,
        ]);

        return redirect()->route('admin.dish.index');
    }

    public function delete($id){
        $dish = Dish::Find($id);

        if(!is_null($dish->image)){
            $image_path = $dish->image;
            // Issue due to storage link, have to change it to public instead of storage
            $image_path = "public/".explode('/', $image_path)[1];

            //Storage::delete($image_path);

            // This line of code is for production, issue in transfering to public/storage folder

            $old_img_name = explode('/', $image_path)[1];
            unlink('../public/storage/'.$old_img_name);
        }

        $dish->delete();

        return redirect()->route('admin.dish.index');
    }

}
