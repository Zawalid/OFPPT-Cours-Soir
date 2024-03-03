<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()  {
        $allPubliee = User::all();
        $anneeFormation = [];
        $categorie = [];
        $allTrashed = [];
        $publieeUsers = User::paginate(10);
        $trashedUsers = [];
        return view("users.index", compact(["publieeUsers","trashedUsers",'allPubliee',"allTrashed",'anneeFormation','categorie']));
    }
    public function show(User $user){
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.show', compact('user', 'roles', 'permissions'));
    }
    public function edit(User $user){
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.edit', compact( ['user','roles','permissions']));
    }
    public function assignRole(Request $request, User $user){
        if ($user->hasRole($request->role)) {
            return back()->with('message', 'Role exists.');
        }
        $user->assignRole($request->role);
        return back()->with('message', 'Role assigned.');
    }
    public function removeRole(User $user, Role $role){
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'Role removed.');
        }
        return back()->with('message', 'Role not exists.');
    }
    public function givePermission(Request $request, User $user){
        if ($user->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission exists.');
        }
        $user->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }
    public function revokePermission(User $user, Permission $permission){
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission does not exists.');
    }
}
