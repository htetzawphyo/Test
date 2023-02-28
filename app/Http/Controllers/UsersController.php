<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('CreateUser', ['only' => ['store', 'add']]);
        $this->middleware('ReadUser', ['only' => ['index']]);
        $this->middleware('UpdateUser', ['only' => ['edit', 'update']]);
        $this->middleware('DeleteUser', ['only' => ['delete']]);
    }
    // public function __construct()
    // {
    //     $this->middleware('Test');
    // }

    public function index() 
    {
        // $permission_ids = Permissions::all(['id']);
        // $filtered_permission_id = [];
        // $user_permissions = [];

        // foreach(Auth::user()->roles->permissions as $key => $permission){
        //     $user_permissions[] = $permission->id;
        // }

        // foreach($permission_ids as $per_id){
        //     $filtered_permission_id[] = $per_id->id;
        //     $check = in_array($per_id->id,$user_permissions);
        // }

        // dd();

        $users = User::with('roles')->get();
        $roles = Role::with('permissions')->get();
        return view('user_management.users.list', compact('users', 'roles'));
    }

    public function store(UserCreateRequest $request)
    {
        $user = new User();
        $user->name = $request->full_name;
        $user->username = $request->user_name;
        $user->role_id = $request->user_role;
        $user->phone = $request->user_phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->user_password);
        $user->gender = $request->user_gender;
        if($request->active) {
            $user->is_active = 1;
        }else {
            $user->is_active = 0;
        }

        $user->save();

        return redirect('users')->with('message', 'User Created Successfully');
    }

    public function add()
    {
        $roles = Role::with('permissions')->get();
        return view('user_management.users.user-add', compact('roles'));
    }

    public function edit(User $user)
    {
        $roles = Role::with('permissions')->get();
        return view('user_management.users.edit', compact('roles', 'user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {   
        $user->name = $request->full_name;
        $user->username = $request->user_name;
        $user->role_id = $request->user_role;
        $user->phone = $request->user_phone;
        $user->email = $request->email;
        if($request->user_password){
            $user->password = Hash::make($request->user_password);
        }
        $user->gender = $request->user_gender;
        if($request->active) {
            $user->is_active = 1;
        }else {
            $user->is_active = 0;
        }

        $user->save();

        return redirect('users')->with('message', 'User Updated Successfully');
    }

    public function delete(User $user)
    {
        $user->delete();

        return back()->with('message', 'Deleted Successfully.');
    }
}
