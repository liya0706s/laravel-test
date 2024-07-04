<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>創建照片</title>
</head>
<body>
    <h1>創建照片</h1>

    <form action=" {{ route('photos.store') }} " method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">標題:</label>
        <input type="text" name="title" id="title" required>

        <label for="description">描述:</label>
        <textarea name="description" id="description"></textarea>

        <label for="image">圖片:</label>
        <input type="file" name="image" id="image" required>

        <button type="submit">提交</button>
    </form>
</body>
</html>