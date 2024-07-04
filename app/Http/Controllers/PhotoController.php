<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     * 顯示所有照片
     */
    public function index()
    {
        $photos=Photo::all();
        return view('photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     * 顯示創建新照片的表單
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 驗證請求數據
        $validateData=$request->validate([
            'title'=>'required|string|max:255',
            'discription'=>'nullable|string',
            'image'=>'required|image|max:2048', // 假設要上傳圖片並限制大小為2MB
        ]);

        // 將驗證通過的數據保存到數據庫
        $photo=new Photo();
        $photo->title=$validateData['title'];
        $photo->description=$validateData['description'];

        // 保存上傳的圖片
        if($request->hasFile('image')){
            $imagePath=$request->file('image')->store('photos','public');
            $photo->image_path=$imagePath;
        }

        $photo->save();

        // 返回響應或重定向到其他頁面
        return redirect()->route('photos.index')->with('success', '照片已成功創建!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $photo=Photo::findOrFail($id);  // 根據 $id 查找相應的照片資源

        return view('photos.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
