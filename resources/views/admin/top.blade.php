@extends('layouts.admin_header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="mx-2">
                        <p>ユーザーネーム：{{ $username }}</p>
                        <p>メールアドレス：{{ $email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
