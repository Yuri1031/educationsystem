@extends('layouts.user_header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table table-borderless align-middle">
            <thead>
                <tr>
                    <th>
                        <div class="mb-3 text-nowrap">
                            <h2><a href="/home">←戻る</a></h2>
                        </div>
                    </th>
                    <th colspan="3">
                        <div class="row">
                            <div class="col">
                                <!-- 月の変更 -->
                                <h2 class="current-month text-nowrap">
                                    <a href="#" class="month-change-link" data-year="{{ $previousMonth->year }}" data-month="{{ $previousMonth->month }}">◀</a>
                                    {{ $currentYear }}年{{ $currentMonth }}月スケジュール
                                    <a href="#" class="month-change-link" data-year="{{ $nextMonth->year }}" data-month="{{ $nextMonth->month }}">▶</a>
                                </h2>
                            </div>
                            <div class="col">
                                <!-- 選択中の学年を表示 -->
                                <button type="button" id="selected-grade" class="btn btn-info">
                                    {{ $gradeName ?? '全ての学年' }}
                                </button>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="2">
                        <!-- 学年選択ボタン -->
                        <form id="grade-form" action="{{ route('user.curriculums') }}" method="GET">
                            @foreach($grades as $grade)
                                <div class="mb-3 text-nowrap">
                                    <button type="button" class="btn btn-info grade-button" data-grade-id="{{ $grade->id }}">
                                        {{ $grade->name }}
                                    </button>
                                </div>
                            @endforeach
                            <input type="hidden" name="grade_id" id="grade-id-input" value="{{ $gradeId }}">
                            <input type="hidden" name="year" id="current-year-input" value="{{ $currentYear }}">
                            <input type="hidden" name="month" id="current-month-input" value="{{ $currentMonth }}">
                        </form>
                    </td>
                    <!-- 授業一覧 -->
                    <td colspan="3">
                        <table class="table table-borderless">
                            <tbody id="curriculums-container">
                                @include('user.list', ['curriculums' => $curriculums])
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr></tr>
                <tr>
                    <td colspan="4">
                        <div id="pagination-links">
                            {{ $curriculums->links() }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
