<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯照片</title>
</head>
<body>
    <h1>編輯照片</h1>

    <form action="{{ route('photos.update',$photo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="title">標題:</label>
        <input type="text" name="title" value="{{ $photo->title }}" required>
        
        <label for="description">敘述:</label>
        <textarea name="description" id="description"> {{ $photo->description }} </textarea>
        
        <label for="image">圖片:</label>
        <input type="file" name="image" id="image">
        
        <button type="submit">更新</button>
    </form>
</body>
</html>