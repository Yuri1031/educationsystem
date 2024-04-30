@extends('layouts.admin_header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="mx-2">
                        <p>ユーザーネーム：{{ Auth::user()->name }}</p>
                        <p>メールアドレス：{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
