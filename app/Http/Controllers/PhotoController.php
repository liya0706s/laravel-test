<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;  // 引入 Photo 模型

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     * 顯示所有照片
     */
    public function index()
    {
        // 從數據庫中獲取所有照片紀錄
        $photos = Photo::all();

        // 返回 'photos.index' 視圖，並將 $photos 變量傳遞給該視圖
        return view('photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     * 顯示創建新照片的表單
     */
    public function create()
    {
        // 返回 'photos.create' 視圖，該視圖將顯示創建照片的表單
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     * 將新照片保存到數據庫
     */
    public function store(Request $request)
    {
        // 驗證請求數據
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|max:2048', // 假設要上傳圖片並限制大小為2MB
        ]);

        // 將驗證通過的數據保存到數據庫
        $photo = new Photo();
        $photo->title = $validateData['title'];
        $photo->description = $validateData['description'];

        // 保存上傳的圖片
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('photos', 'public');
            $photo->image_path = $imagePath;
        }

        $photo->save();

        // 返回響應或重定向到其他頁面
        return redirect()->route('photos.index')->with('success', '照片已成功創建!');
    }

    /**
     * Display the specified resource.
     * 顯示特定照片的詳細信息
     */
    public function show(string $id)
    {
        // 根據傳入的 id 查找特定的照片。如果找不到，將拋出一個 404 異常。
        $photo = Photo::findOrFail($id);

        // 返回 'photos.show' 視圖，並傳遞 $photo 變量到該視圖
        return view('photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     * 顯示編輯特定照片的表單
     */
    public function edit(string $id)
    {
        // 查找指定 ID 的照片，如果找不到則拋出 404 異常
        $photo = Photo::findOrFail($id);  

        // 返回 'photos.edit' 視圖，並將 $photo 變量傳遞給該視圖
        return view('photos.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     * 更新特定照片的信息
     */
    public function update(Request $request, string $id)
    {
         // 驗證表單提交的數據
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // 查找指定 ID 的照片記錄
        $photo = Photo::findOrFail($id);
        $photo->title=$validateData['title'];
        $photo->description=$validateData['description'];

        // 如果請求中包含圖片文件，則保存圖片到存儲目錄中並更新 image_path 屬性
        if($request->hasFile('image')){
            $imagePath=$request->file('image')->store('photos', 'public');
            $photo->image_path=$imagePath;
        }

        // 將更新後的照片數據保存到數據庫中
        $photo->save();

        // 重定向到照片列表頁面並帶有成功提示信息
        return redirect()->route('photos.index')->with('success','照片已更新成功!');
    }


    /**
     * Remove the specified resource from storage.
     * 刪除特定照片
     */
    public function destroy(string $id)
    {
        // 查找指定 ID 的照片記錄
        $photo=Photo::findOrFail($id);
        
        // 刪除照片記錄
        $photo->delete();

        // 重定向到照片列表頁面並帶有成功提示信息
        return redirect()->route('photos.index')->with('success', '照片已成功刪除!');
    }
}
