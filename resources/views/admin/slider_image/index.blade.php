@extends('admin.master')
@section('content')
    <div class="card-body p-0">
        <div class="card">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="card-body">
                <a class="btn btn-success btn-sm" href="{{ route('admin.slider_image.add') }}">
                    <i class="fas fa-plus">
                    </i>
                    Thêm Ảnh Trang Chủ
                </a>
            </div>
        </div>
        <table class="table table-striped projects">
            <thead>
            <tr>
                <th style="width: 1%">
                    #
                </th>
                <th style="width: 30%">
                    Ảnh
                </th>
                <th>
                    Ngày Tạo
                </th>
                <th style="width: 20%">
                    Chức năng
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($slider_images as $slider_image)
                <tr>
                    <td>
                        {{$slider_image['id']}}
                    </td>
                    <td>
                        <img src="{{ asset('images/'.($slider_image['image'])) }}" style="max-height:150px">
                    </td>
                    <td>
                        {{$slider_image['created_at']}}
                    </td>
                    <td class="project-actions">
                        <a class="btn btn-info btn-sm" href="{{ route('admin.slider_image.edit', $slider_image['id'] ?? 0) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Sửa
                        </a>
                        <form action="{{ route('admin.slider_image.destroy', $slider_image['id'] ?? 0)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fas fa-trash">
                                </i>
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    <?php echo $slider_images->render(); ?>
@endsection
