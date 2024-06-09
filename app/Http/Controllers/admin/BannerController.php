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
    
            // 最新のバナーリストを取得
            $banners = Banner::all();
    
            if ($request->ajax()) {
                $html = view('admin.bannerlist', compact('banners'))->render();
                return response()->json([
                    'success' => 'バナーが登録されました。',
                    'html' => $html
                ]);
            }
    
            return redirect('admin/banner')->with('success', 'バナーが登録されました。');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Failed to upload image: ' . $e->getMessage()], 500);
            }
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
    
                // 既存の画像があれば削除する
                if ($banner->image) {
                    $oldImagePath = storage_path('app/public/images/') . $banner->image;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
    
                // 新しい画像を保存
                $image->storeAs('public/' . $dir, $imageName);
                $banner->image = $imageName;
            }
    
            $banner->save();
    
            // Ajaxリクエストでのレスポンス
            if ($request->ajax()) {
                $imageUrl = asset('storage/images/' . $banner->image);
                return response()->json([
                    'imageUrl' => $imageUrl,
                    'success' => 'Image updated successfully.'
                ]);
            }
    
            return back()->with('success', 'Image updated successfully.');
        } catch (\Exception $e) {
            // エラー時のレスポンス
            if ($request->ajax()) {
                return response()->json(['error' => 'Failed to update image: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'Failed to update image: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $banner = Banner::findOrFail($id);

            // 画像ファイルの削除
            if ($banner->image) {
                $imagePath = storage_path('app/public/images/' . $banner->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                } else {
                    Log::warning('File not found: ' . $imagePath);
                }
            }

            $banner->delete(); // データベースからバナーを削除

            // 最新のバナーリストを取得
            $banners = Banner::all();

            if (request()->ajax()) {
                return response()->json([
                    'html' => view('admin.bannerlist', compact('banners'))->render()
                ]);
            }

            return redirect()->route('admin.banners.index')->with('success', 'バナーが削除されました。');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json(['error' => '削除に失敗しました: ' . $e->getMessage()], 500);
            }
            return redirect()->route('admin.banners.index')->with('error', '削除に失敗しました: ' . $e->getMessage());
        }
    }
}
