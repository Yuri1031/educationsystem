{{--

一覧画面は慣習的に、indexと名付けることが多いです。今回は『授業一覧画面』をindex.blade.phpとして取り扱っています。
こちらのファイルは、元々curriculums.blade.phpだったものを改修したものです。

--}}

<!DOCTYPE html>
<html lang="ja" translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- app.cssでは、汎用的なスタイルを定義している -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/curriculums/curriculums.css') }}">
    <title>授業設定</title>
</head>
<body>
    <!-- 共通ヘッダーをインクルード -->
    @include('admin_header')

    <!-- 授業一覧 -->
    <div class="wrapper">

        <div class="header">
            <!-- 戻るボタンを押すと管理-授業一覧へ戻る形にしたい -->
            <a class="header__back" href="{{ route('curriculums.list.default') }}">←戻る</a>
            <h1 class="header__title">授業一覧</h1>
        </div>


        <div class="content">

            <div class="menu">
                <a class="menu__register-btn bg-btn-primary border"
                   href="{{ route('curriculums.create') }}">新規登録</a>

                <div class="menu__item-wrapper">
                    @foreach($grades as $grade)
                        <a class="d-block menu__item border bg-{{ $grade->getDivision() }}"
                           href="{{ route('curriculums.list', [ 'id' => $grade->id ]) }}"
                        >{{ $grade->name }}</a>
                    @endforeach
                </div>
            </div>

            <div class="curriculum-list">
                <div class="curriculum-list__grade border bg-{{ $listed_grade->getDivision() }}">
                    <h1>{{ $listed_grade->name }}</h1>
                </div>

                <div class="curriculum-list__body">
                    @foreach ($curriculums as $curriculum)
                        <div class="curriculum-list__card border">
                            <div>
                                <img width="100%" src="{{ asset('storage/uploads/' . $curriculum->id . '/' . $curriculum->thumbnail) }}" alt="no image"/>

                                <div class="curriculum-list__card-title">
                                    <span>{{ $curriculum->title }}</span>
                                </div>

                                <div class="curriculum-list__card-delivery-times">
                                    @if ($curriculum->always_delivery_flg)
                                        <span>常時公開</span>
                                    @else
                                        @php
                                            $delivery_times = $curriculum->getDeliveryTimes();
                                        $max_display = 4;
                                        @endphp
                                        @for ($i = 0; $i < $max_display; $i++)
                                            @if ($i < count($delivery_times))
                                                @php
                                                    $delivery_time = $delivery_times[$i];
                                                @endphp
                                                <span>{{ $delivery_time->delivery_from->format('n月j日  H:i') }} ~ {{ $delivery_time->delivery_to->format('H:i') }}</span><br>
                                            @endif
                                        @endfor
                                        @if (count($delivery_times) > $max_display)
                                            <span>他{{ count($delivery_times) - $max_display }}件</span>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="curriculum-list__card-actions">
                                <a class="curriculum-list__card-action-btn bg-btn-primary border"
                                   href="{{ route('curriculums.edit', [ 'id' => $curriculum->id, ]) }}"
                                >授業内容編集</a>

                                <a class="curriculum-list__card-action-btn bg-btn-primary border"
                                   @if ($curriculum->always_delivery_flg)
                                       onclick="alert('常時公開に設定されているため、配信日時を編集できません')"
                                   @else
                                       href="{{ route('delivery_times.edit', [ 'curriculums_id' => $curriculum->id, ]) }}"
                                    @endif
                                >配信日時編集</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>
