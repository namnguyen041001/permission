@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Thêm mới vai trò</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('role.update',$role->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="text-strong" for="name">Tên vai trò</label>
                    <input class="form-control" type="text" name="name" value="{{$role->name}}" id="name">
                </div>
                @error('name')
                <small class="text-danger">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label class="text-strong" for="description">Mô tả</label>
                    <textarea class="form-control" type="text" name="description" id="description">{{$role->description}}</textarea>
                </div>
                @error('description')
                <small class="text-danger">{{$message}}</small><br>
                @enderror
                <strong>Vai trò này có quyền gì?</strong>
                <small class="form-text text-muted pb-2">Check vào module hoặc các hành động bên dưới để chọn quyền.</small>
                <!-- List Permission  -->

                @foreach($permissions as $key => $permission)
                <div class="card my-4 border">
                    <div class="card-header">
                        <input type="checkbox" class="check-all" name="" id="{{$key}}">
                        <label for="{{$key}}" class="m-0">Module {{$key}}</label>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($permission as $item)
                            <div class="col-md-3">
                                <input type="checkbox" class="permission" value="{{$item->id}}" @if(in_array($item->id, $role->permission->pluck('id')->toArray())) checked @endif name="permission_id[]" id="{{$item->slug}}">

                                <label for="{{$item->slug}}">{{$item->name}}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
                <input type="submit" name="btn-add" class="btn btn-primary" value="Cập nhật">
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.check-all').click(function() {
        $(this).closest('.card').find('.permission').prop('checked', this.checked)
    })
</script>

@endsection