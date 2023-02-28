<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Features;
use App\Models\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('RoleCreate', ['only' => 'store']);
        $this->middleware('RoleRead', ['only' => 'index']);
        $this->middleware('RoleUpdate', ['only' => 'edit', 'update']);
        $this->middleware('RoleDelete', ['only' => 'delete']);
    }

    public function index() 
    {
        $permissions = Permissions::with('feature', 'roles')->get();
        $features = Features::get();
        $roles = Role::with('permissions')->get();
        return view('user_management.roles.list', compact('permissions', 'features', 'roles'));
    }

    public function store(RoleCreateRequest $request)
    {        
        $role = new Role();
        $role->name = $request->role_name;
        $role->save();
        $permission = $request->input('user_management');
        $permission_id = array_map('intval', $permission);
        $role->permissions()->attach($permission_id);

        return back()->with('message', 'Role Created Successfully');
    }

    public function edit(Role $role)
    {
        $check_permission = [];
        foreach ($role->permissions as $permission) {
            $check_permission[] = $permission->id;
        }
        $permissions = Permissions::with('feature', 'roles')->get();
        $features = Features::get();
        return view('user_management.roles.edit', compact('role', 'permissions', 'features', 'check_permission'));
    }

    public function update(RoleUpdateRequest $request,Role $role)
    {
        $role->name = $request->role_name;
        $role->save();
        $permission = $request->input('user_management');
        $permission_id = array_map('intval', $permission);
        $role->permissions()->sync($permission_id);
        
        return redirect('roles')->with('message', 'Role Updated Successfully');
    }

    public function delete(Role $role)
    {        
        $role->delete();
        $permission_id = $role->permissions()->pluck("permissions_id");
        $role->permissions()->detach($permission_id);

        return back()->with('message', 'Role Deleted Successfully');
    }
}
