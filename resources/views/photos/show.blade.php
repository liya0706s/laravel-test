<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ $photo->title }} </title>
</head>

<body>
    <h1> {{$photo->title}} </h1>
    <p> {{ $photo->description}} </p>
    <img src=" {{ asset('storage/' . $photo->image_path) }} " alt=" {{ $photo->title }} ">
    <a href="{{route('photos.index')}}">返回</a>
</body>
</html>