@extends('layouts.user_header')

@section('content')
<div class="container">
<div class="row justify-content-center">
<table class="table table-borderless align-middle">
    <thead>
        <tr>
            <th><div class="mb-3"><h2><a href="javascript:history.back()">←戻る</a></h2></div></th>
            <th colspan="3">
                <div class="row">
                    <div class="col">
                    <!-- ◀▶を押すと月替変わるようにする -->
                    <h2>◀{{ $currentYear }}年{{ $currentMonth }}月スケジュール▶</h2>
                    </div>
                    <div class="col">
                        <!-- ユーザーの学年を表示させる -->
                        <button type="button" class="btn btn-info">小学１年生</button>
                    </div>
                </div>
                </div>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan="2">
                <!-- 学年選択ボタン -->
                <div class="mb-3"><button type="button" class="btn btn-info">小学1年生</button></div>
                <div class="mb-3"><button type="button" class="btn btn-info">小学2年生</button></div>
                <div class="mb-3"><button type="button" class="btn btn-info">小学3年生</button></div>
                <div class="mb-3"><button type="button" class="btn btn-info">小学4年生</button></div>
                <div class="mb-3"><button type="button" class="btn btn-info">小学5年生</button></div>
                <div class="mb-3"><button type="button" class="btn btn-info">小学6年生</button></div>
                <div class="mb-3"><button type="button" class="btn btn-primary">中学1年生</button></div>
                <div class="mb-3"><button type="button" class="btn btn-primary">中学2年生</button></div>
                <div class="mb-3"><button type="button" class="btn btn-primary">中学3年生</button></div>
                <div class="mb-3"><button type="button" class="btn btn-success">高校1年生</button></div>
                <div class="mb-3"><button type="button" class="btn btn-success">高校2年生</button></div>
                <div class="mb-3"><button type="button" class="btn btn-success">高校3年生</button></div>
            </td>
            <td>
                <!-- 授業一覧、配信期間設定 -->
                <div class="card mx-5 text-center">
                    <img src="" width="200px">
                    <div class="">あああ</div>
                    <div class="">あああ</div>
                </div>
            </td>
            <td>
                <div class="card mx-5 text-center">
                    <img src="" width="200px">
                    <div class="">あああ</div>
                    <div class="">あああ</div>
                </div>
            </td>
            <td>
                <div class="card mx-5 text-center">
                    <img src="" width="200px">
                    <div class="">あああ</div>
                    <div class="">あああ</div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="card mx-5 text-center">
                    <img src="" width="200px">
                    <div class="">あああ</div>
                    <div class="">あああ</div>
                </div>
            </td>
            <td>
                <div class="card mx-5 text-center">
                    <img src="" width="200px">
                    <div class="">あああ</div>
                    <div class="">あああ</div>
                </div>
            </td>
            <td>
                <div class="card mx-5 text-center">
                    <img src="" width="200px">
                    <div class="">あああ</div>
                    <div class="">あああ</div>
                </div>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
</div>
</div>
@endsection
