@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm người dùng
        </div>
        <div class="card-body">
            <form action="{{url('admin/users/store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name">
                </div>
                @error('name')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email">
                </div>
                @error('email')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="email">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="email">
                </div>
                @error('password')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="Confirm-password">Xác nhận mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirmation" id="Confirm-password">
                </div>

                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select class="form-control" id="">
                        <option>Chọn quyền</option>
                        <option>Danh mục 1</option>
                        <option>Danh mục 2</option>
                        <option>Danh mục 3</option>
                        <option>Danh mục 4</option>
                    </select>
                </div>

                <button type="submit" name="btn-add" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection