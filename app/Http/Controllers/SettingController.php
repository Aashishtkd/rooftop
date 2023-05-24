<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Auth;

class SettingController extends Controller
{
    public function websetting()
    {
        $setting = Setting::with('admin')->select('*')->first();
        return view('admin.settings.web',compact('setting'));
    }
    public function update(Request $req)
    {
        $userId = Auth::id();
        if($req->defoultPass){
            $req->validate([
                'defoultPass'=>'min:8',
            ]); 
        }
        if($req->id){
            if($req->ajax()){
                $blog = Setting::where('id',$req->id)->update([
                    'email' => $req->input('email'),
                    'phone' => $req->input('phone'),
                    'mobile' => $req->input('mobile'),
                    'map' => $req->input('map'),
                    'facebook' => $req->input('facebook'),
                    'insta' => $req->input('insta'),
                    'youtube' => $req->input('youtube'),
                    'twitter' => $req->input('twitter'),
                    'tiktok' => $req->input('tiktok'),
                    'address' => $req->input('address'),
                    'copyright' => $req->input('copyright'),
                    'aboutus' => $req->input('aboutus'),
                    'defoultPass' => $req->input('defoultPass'),
                    'updatedBy' => $userId ,
                ]);
                return Response()->json([
                    'status' => 200,
                    'message' => 'Setting Updated Successfully.',
                ]);

            }
        }else{
            if($req->ajax()){
                $blog = Setting::create([
                    'email' => $req->input('email'),
                    'phone' => $req->input('phone'),
                    'mobile' => $req->input('mobile'),
                    'map' => $req->input('map'),
                    'facebook' => $req->input('facebook'),
                    'insta' => $req->input('insta'),
                    'youtube' => $req->input('youtube'),
                    'twitter' => $req->input('twitter'),
                    'tiktok' => $req->input('tiktok'),
                    'address' => $req->input('address'),
                    'copyright' => $req->input('copyright'),
                    'aboutus' => $req->input('aboutus'),
                    'defoultPass' => $req->input('defoultPass'),
                    'updatedBy' => $userId ,
                ]);
                return Response()->json([
                    'status' => 200,
                    'message' => 'Setting Added Successfully.',
                ]);
            }
        }
    }
}

