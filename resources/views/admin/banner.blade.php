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
    </tbody>
    <tfoot>
    </tfoot>
</table>

<!-- 新規登録  -->
<form action="{{ route('admin.banners.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <table class="table table-borderless align-middle">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="preView">
            <tr>
                <td><div id="view_1"></div></td>
                <td>
                    <div class="container mt-5">
                    <div class="input-group mb-3">
                        <input type="file" id="file_1" name="image[]" class="form-control">
                        <button class="btn btn-outline-secondary add-image-btn" type="button">+</button>
                    </div>
                    </div>
                </td>
                <td></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td><input type="submit" class="btn btn-primary" name="send" value="登録"></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    <span id="message"></span>
</form>


</div>
</div>
</div>
</div>
@endsection