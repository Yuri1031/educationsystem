@if(count($banners) > 0)
    @foreach($banners as $banner)
        <tr>
            <td>
                <img src="{{ asset('storage/images/' . $banner->image) }}" alt="Banner Image" class="img-fluid" width="200px">
            </td>
            <td>
                <form action="{{ route('admin.banners.update', $banner->id) }}" method="post" enctype="multipart/form-data" class="update-banner-form" data-id="{{ $banner->id }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="banner_id" value="{{ $banner->id }}">
                    <input type="file" name="image">
                    <input type="submit" name="send" value="変更">
                </form>
            </td>
            <td>
                <form method="POST" action="{{ route('admin.banners.destroy', $banner->id) }}" class="d-inline delete-banner-form" data-id="{{ $banner->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-circle p-0" style="width:2rem;height:2rem;">-</button>
                </form>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="3">バナーがありません。</td>
    </tr>
@endif
