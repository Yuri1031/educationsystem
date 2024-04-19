<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.class_list', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move(public_path('images'), $imageName);

        Banner::create(['image' => $imageName]);

        return back()
            ->with('success','Image uploaded successfully');
    }

    public function destroy($id)
    {
        Banner::find($id)->delete();
        return back()
            ->with('success','Image removed successfully');
    }
}
