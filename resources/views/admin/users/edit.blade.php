@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật người dùng
        </div>
        <div class="card-body">
            <form action="{{route('update.user',$user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" value="{{$user->name}}" id="name">
                </div>
                @error('name')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" value="{{$user->email}}" id="email" readonly="readonly">
                </div>
                <!-- <div class="form-group">
                    <label for="email">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="email">
                </div>
                @error('password')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="Confirm-password">Xác nhận mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirmation" id="Confirm-password">
                </div> -->
                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select multiple name="roles[]" class="form-control" id="">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" @if(in_array($role->id,$user->roles->pluck('id')->toArray())) selected @endif>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" name="btn-update" value="Thêm mới" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection