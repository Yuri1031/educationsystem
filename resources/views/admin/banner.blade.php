@extends('layouts.admin_header')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">

                <!-- フラッシュメッセージの表示 -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <table class="table table-borderless align-middle">
                    <thead>
                        <tr>
                            <th>
                                <div class="mb-3 text-nowrap">
                                    <h2><a href="/admin/top">←戻る</a></h2>
                                </div>
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th><H2>バナー管理</H2></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="banner">
                        @include('admin.bannerlist', ['banners' => $banners])
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>

                <!-- 新規登録  -->
                <form id="bannerForm" action="{{ route('admin.banners.store') }}" method="post" enctype="multipart/form-data">
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
                                <td><input type="submit" id='submitBtn' class="btn btn-primary" name="send" value="登録"></td>
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

<!-- スクリプトの読み込み -->
<script src="{{ asset('js/banner.js') }}"></script>

@endsection
