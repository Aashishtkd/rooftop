<?php

namespace App\Http\Controllers;

use App\Models\DishCategory;
use Illuminate\Http\Request;

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

    public function add(){
        return view('admin.dishcategory.add');
    }

    public function create(Request $request){
        $request->validate([
            "name"=>"required"
        ]);

        DishCategory::create([
            "name"=>$request->get("name")
        ]);

        return redirect()->route('admin.dishcategory.index');
    }

    public function edit($id){
        $category = DishCategory::find($id);

        return view('admin.dishcategory.edit', ["category"=>$category]);
    }

    public function update(Request $request){
        $request->validate([
            "name"=>"required"
        ]);

        $category = DishCategory::find($request->get("id"));
        $category->name = $request->get("name");
        $category->save();

        return redirect()->route('admin.dishcategory.index');
    }

    public function delete($id){
        $category = DishCategory::find($id);

        $category->delete();
        return redirect()->route('admin.dishcategory.index');
    }
}
