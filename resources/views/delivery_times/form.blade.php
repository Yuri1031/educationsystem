@php
@endphp

<!DOCTYPE html>
<html lang="ja" translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/delivery_times/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    {{-- CDNでFontAwesomeのアイコンを読み込む --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

{{--    <script src="{{ asset('js/delivery_times/delivery.js') }}"></script>--}}
    <title>配信日時設定</title>
</head>
<body>
    @include('admin_header') <!-- 共通ヘッダーをインクルード -->
    <div class="wrapper">

        <div class="header">
            <a class="header__back" href="{{ route('curriculums.list.default') }}">←戻る</a>
            <h1 class="header__title">配信日時設定</h1>
        </div>

        <div class="content">

            <div class="delivery-time-form__curriculum-title">
                <h2>{{ $curriculum->title }}</h2>
            </div>

            <form action="#" method="POST" enctype="multipart/form-data" class="delivery-time-form__body">
                @csrf
                <div class="delivery-time-form__fields-wrapper">
                </div>
                <button type="button" class="add-button delivery-time-form__add-btn border">
                    <i class="fa-sharp fa-solid fa-plus"></i>
                </button>
                <button type="submit" class="delivery-time-form__register-btn form__register-btn bg-btn-secondary">登録</button>
            </form>
        </div>
    </div>
</body>
<script type="module">
    import InputFieldsManager from "{{ asset('js/delivery_times/delivery.js') }}";
    import DeliveryTimesClient from "{{ asset('js/delivery_times/client.js') }}";

    // clientがリクエストを送信する
    const client = new DeliveryTimesClient({{ $curriculum->id }});
    // managerが<input>グループの追加と、clientへの値の受け渡しを行う
    const manager = new InputFieldsManager('.delivery-time-form__fields-wrapper', client);

    // 初めにdelivery_timesの分だけ、<input>グループを追加して、初期値をあてはめる。
    @if (count($delivery_times) > 0)
        @foreach ($delivery_times as $delivery_time)
        manager.appendFields(
        "{{ $delivery_time->id }}",
        "{{ $delivery_time->getDeliveryDateFrom() }}",
        "{{ $delivery_time->getDeliveryTimeFrom() }}",
        "{{ $delivery_time->getDeliveryDateTo() }}",
        "{{ $delivery_time->getDeliveryTimeTo() }}");
        @endforeach
    @else // この$curriculumに一つもDeliveryTimeが紐付いていない場合は、空の<input>グループを一つ用意する。
        manager.appendFields();
    @endif

        // 追加ボタンを押すと<input>のグループを追加する
    $('.delivery-time-form__add-btn').click((e) => {
        manager.appendFields();
    });

    //  登録ボタンを押すと、clientにリクエストを送信させる
    $('.delivery-time-form__register-btn').click((e) => {
        e.preventDefault();
        client.sendRequest().then((results) => {
            // リクエストが完了したら、授業一覧画面へリダイレクト
            window.location.href = '{{ route('curriculums.list.default') }}';
        });
    });
</script>
</html>