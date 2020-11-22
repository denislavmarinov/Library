<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('users')->get();

        return view('roles.index', compact('roles'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role = Role::show_roles_with_users($role);
        $roles = Role::all();

        $roles = $roles->pluck('role', 'id');

        foreach ($roles as $k => $v)
        {
            $roles[$k] = ucfirst(str_replace('_', ' ', $v));
        }

        return view('roles.show', compact('role', 'roles'));
    }
}
