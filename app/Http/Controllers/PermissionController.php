<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    function __construct()
    {
        $this->middleware(function($request, $next){
            session(['module_active'=>'permission']);
            return $next($request);
        });
    }

    function add(){
        $permissions = Permission::all()->groupBy(function ($permission){
            return explode('.',$permission->slug)[0];//Điều này có nghĩa là các quyền có cùng phần tử đầu tiên của "slug" sẽ được nhóm lại với nhau.
        });
        # 3 dòng trên sẽ tạo ra một mảng đa cấp chạy đoạn sau sẽ rõ: return $permissions;

        return view("admin.permission.add",compact('permissions'));
    }

    function store(Request $request){
        $request->validate(
            [
                'name' => 'required|max:255',
                'slug' => 'required',
            ],
            [
                'required' => ":attribute không được để trống",
                'max' => ":atribute phải ít hơn :max kí tự",
            ],
            [
                'name' => 'Tên quyền',
                'slug' => "Slug"
            ]
        );
        Permission::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description')
        ]);
        return redirect()->route("permission.add")->with('status',"Thêm vai trò thành công");
    }

    function edit($id){
        $permissions = Permission::all()->groupBy(function ($permission){
            return explode('.',$permission->slug)[0];//Điều này có nghĩa là các quyền có cùng phần tử đầu tiên của "slug" sẽ được nhóm lại với nhau.
        });
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact('permissions','permission'));
    }
    function update(Request $request, $id){
        $request->validate(
            [
                'name' => 'required|max:255',
                'slug' => 'required',
            ],
            [
                'required' => ":attribute không được để trống",
                'max' => ":atribute phải ít hơn :max kí tự",
            ],
            [
                'name' => 'Tên quyền',
                'slug' => "Slug"
            ]
        );
        Permission::where('id',$id)->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description')
        ]);
        return redirect()->route("permission.add")->with('status',"Cập nhật thành công");
    }

    function delete($id){
        Permission::where('id',$id)->delete();
        return redirect()->route("permission.add")->with('status',"Xóa thành công");

    }

}
