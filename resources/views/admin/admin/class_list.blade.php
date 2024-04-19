<!DOCTYPE html>
<html>
<head>
    <title>Banner Management</title>
</head>
<body>

<div>
    <h2>ヘッダー</h2>
    <hr>

    @foreach($banners as $banner)
        <div>
            <img src="{{ asset('images/' . $banner->image) }}" alt="Banner Image">
            <form action="{{ route('banners.destroy',$banner->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">-</button>
            </form>
        </div>
    @endforeach

    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        <button type="submit">登録</button>
    </form>
    <button onclick="addBanner()">+</button>
</div>

</body>
</html>
