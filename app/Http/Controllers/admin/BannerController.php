<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        try {
            $banners = Banner::all();
            return view('admin.banner', compact('banners'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load banners: ' . $e->getMessage());
        }
    }

    public function create(Request $request)
    {
        return view('admin.banner');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            if($request->hasfile('image'))
            {
                foreach($request->file('image') as $key => $image)
                {
                    $name = now()->format('YmdHis') . '_' . $key . '_' . $image->getClientOriginalName();
                    $image->storeAs('public/images', $name);
    
                    $banner = new Banner;
                    $banner->image = $name;
                    $banner->save();
                }
            }
    
            return redirect('admin/banner')->with('success', 'Image uploaded successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to upload image: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            $banner = Banner::findOrFail($id);
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = now()->format('YmdHis') . '_' . $image->getClientOriginalName();
                $dir = 'images';
    
                if ($banner->image) {
                    $oldImagePath = storage_path('app/public/images/') . $banner->image;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
    
                $image->storeAs('public/' . $dir, $imageName);
                $banner->image = $imageName;
            }
    
            $banner->save();
    
            return redirect('admin/banner')->with('success', 'Image updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update image: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            
            $imagePath = storage_path('app/public/images/' . $banner->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            
            $banner->delete();
            
            return redirect()->route('admin.banner')->with('success', '画像を削除しました。');
        } catch (\Exception $e) {
            return back()->with('error', '画像の削除に失敗しました: ' . $e->getMessage());
        }
    }
}
