@extends('layouts.admin_header')

@section('content')

<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="text-center">

<table class="table table-borderless align-middle">
    <thead>
        <tr>
        <th><H2>バナー管理</H2></th>
        <th></th>
        <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($banners as $banner)
    <tr>
        <td>
            <img src="{{ asset('storage/images/' . $banner->image) }}" alt="Banner Image" class="img-fluid" width="200px">
        </td>
        <td>
            <form action="{{ route('admin.banners.update', $banner->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <input type="hidden" name="banner_id" value="{{ $banner->id }}">
                <input type="file" name="image">
                <input type="submit" name="send" value="変更">
            </form>
        </td>
        <td>
            <form method="POST" action="{{ route('admin.banners.destroy', $banner->id) }}" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger rounded-circle p-0" style="width:2rem;height:2rem;">-</button>
            </form>
        </td>
    </tr>
    @endforeach
    <tr>
        <td><div id="view_1"></div></td>
        <td>
        <form action="{{ route('banners.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="banner_id" value="">
            <input type="file" id="file_1" name="image">
        </td>
        <td></td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td><button id="add" type="button" class="btn btn-info rounded-circle p-0" style="width:2rem;height:2rem;">+</button></td>
        <td><input type="submit" name="send" value="登録"></td>
        </form>
    </tr>
    </tfoot>
</table>
<span id="message"></span>

</div>
</div>
</div>
</div>
@endsection
