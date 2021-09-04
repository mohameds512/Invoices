<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    function __construct()
    {

        $this->middleware('permission:عرض صلاحية' , ['only'=>['index']]);
    }

    public function index()
    {
        $roles = Role::all();
        return view('roles.roles', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create_role',compact('permissions'));
    }

    public function store(Request $request){

        $roles = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        $permissions = $request->permissions_id;

        $roles->syncPermissions($permissions);

        session()->flash('Add');
        return redirect('/roles');

    }

    public function show($id)
    {
        $roles = Role::where('id',$id)->first();

        $permissions = $roles->permissions;

        return view('roles.show_roles',compact('permissions','roles'));
    }

    public function edit($id)
    {

        $role = Role::where('id',$id)->first();
        $permissions = Permission::get();
        return view('roles.edit_role',compact('role' ,'permissions'));
    }

    public function update(Request $request)
    {
        return $request;
    }

    public function destroy($id)
    {

        $role = Role::where('id',$id)->first();
        $role->delete();
        session()->flash('Delete');
        return redirect('roles');

    }
}
