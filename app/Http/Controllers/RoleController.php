<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('name')->where('name','!=','super-user')->get();
        return view ('roles.index', compact([
            'roles'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->get();
        return view ('roles.create', compact([
            'permissions'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'permissions.*'=>'required|integer|exists:permissions,id',
        ]);
        $newRole = Role::create([
            'name'=> $request->name
        ]);
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $newRole->syncPermissions($permissions);

        return redirect()->back()->with('status', 'Role added');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role = Role::where('name','!=','super-user')->findOrFail($role->id);
        $permissions = Permission::orderBy('name')->get();
        return view ('roles.edit', compact([
            'permissions',
            'role'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        $request->validate([
            'name'=>'required|max:255',
            'permissions'=>'required',
            'permissions.*'=>'required|integer|exists:permissions,id',
        ]);

        $role = Role::where('name','!=','super-user')->findOrFail($role->id);
        $role->update([
            'name'=>$request->name,
        ]);
        $permissions = Permission::where('id', $request->permissions)->get();
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('status', 'Role updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('dashboard')->with('status', 'Post '.$role->name.' deleted');
    }
}
