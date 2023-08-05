<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;



class RoleController extends Controller
{
    function index()
    {
        // if(!Gate::allows('role.view')){
        //     abort(403);
        // }

        $roles = Role::all();
        return view("admin.role.list", compact('roles'));
    }

    function add()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        return view('admin.role.add', compact('permissions'));
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:roles,name|max:255',
                'description' => 'required|max:255',
                'permission_id' => 'nullable|array',
            ],
            [
                'required' => ":attribute không được để trống",
                'max' => ":atribute phải ít hơn :max kí tự",
                'unique' => ":attribute đã tồn tại trên hệ thống",
            ],
            [
                'name' => 'Tên quyền',
                'description' => "Mô tả"
            ]
        );

        $role =  Role::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);
        $role->permission()->attach($request->input('permission_id'));
        return redirect()->route("role.index")->with('status', "Thêm vai trò thành công");
    }

    function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        return view("admin.role.edit", compact('permissions', 'role'));
    }

    function update(Request $request, Role $role)
    {
        $validated = $request->validate(
            [
                'name' => 'required|unique:roles,name,' . $role->id,
                'description' => 'required|max:255',
                'permission_id' => 'nullable|array',
                'permission_id.*' => 'exists:permissions,id' //25.35
            ],
            [
                'required' => ":attribute không được để trống",
                'max' => ":atribute phải ít hơn :max kí tự",
                'unique' => ":attribute đã tồn tại trên hệ thống",
            ],
            [
                'name' => 'Tên quyền',
                'description' => "Mô tả"
            ]
        );
        $role->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);
        $role->permission()->sync($request->input('permission_id', []));
        return redirect()->route("role.index")->with('status', "Cập nhật vai trò thành công");
    }

    function delete(Role $role){
        $role->delete();
        return redirect()->route("role.index")->with('status', "Xóa vai trò thành công");
    }
}
