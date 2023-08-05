@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm quyền
                </div>
                @if(session('status'))
                <small class="btn btn-success">{{session('status')}}</small>
                @endif
                <div class="card-body">
                    <form action="{{route('permission.update',$permission->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên quyền</label>
                            <input class="form-control" type="text" value="{{$permission->name}}" name="name" id="name">
                        </div>
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <small class="form-text text-muted pb-2">Ví dụ: posts.add</small>
                            <input class="form-control" type="text" name="slug" value="{{$permission->slug}}" id="slug">
                        </div>
                        @error('slug')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" type="text" name="description" id="description">{{$permission->description}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách quyền
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên quyền</th>
                                <th scope="col">Slug</th>
                                <th scope="col">tác vụ</th>
                                <!-- <th scope="col">Mô tả</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $key => $permission)
                            <tr>
                                <td scope="row"></td>
                                <td><strong>Module {{ucfirst($key)}}</strong></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach($permission as $item)
                            <tr>
                                <td scope="row">1</td>
                                <td>|---{{$item->name}}</td>
                                <td>{{$item->slug}}</td>
                                <td>
                                    <a href="{{route('permission.edit',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('permission.delete',$item->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection