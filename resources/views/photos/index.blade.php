<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>所有照片</title>
</head>
<body>
    <h1>所有照片</h1>    

    <a href="{{ route('photos.create') }}">創建照片</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @foreach ($photos as $photo)
        <div>
            <h2> {{ $photo->title }} </h2>
            <p> {{ $photo->description }} </p>
            <img src=" {{ asset('storage/' . $photo->image_path) }} " alt=" {{ $photo->title }} ">
            <a href=" {{ route('photos.show', $photo->id) }} ">查看</a>
            <a href=" {{ route('photos.edit', $photo->id) }} ">編輯</a>
            <form action="{{ route('photos.destroy', $photo->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">刪除</button>
            </form>
        </div>
    @endforeach
</body>
</html>