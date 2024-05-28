@foreach($curriculums as $curriculum)
<td>
    <div class="card mx-5 text-center" style="width: 210px;">
        <div><img src="{{ asset('storage/images/' . $curriculum->thumbnail) }}" width="200px"></div>
        <div>{{ $curriculum->title }}</div>
        @if($curriculum->alway_delivery_flg === 1)
            @foreach($curriculum->deliveryTimes as $deliveryTime)
                <div>{{ \Carbon\Carbon::parse($deliveryTime->delivery_from)->format('n月j日 H:i') }} 〜 {{ \Carbon\Carbon::parse($deliveryTime->delivery_to)->format('n月j日 H:i') }}</div>
            @endforeach
        @else
            <div>常時配信</div>
        @endif
    </div>
</td>
@if ($loop->iteration % 3 == 0)
    <tr>
@endif
@endforeach
    </tr>
