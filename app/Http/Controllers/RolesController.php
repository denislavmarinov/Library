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
        $roles = Role::with('user')->get();

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
        $role = DB::table('roles')
                    ->join('users', 'roles.id', '=', 'users.role_id')
                    ->select('roles.*', 'users.*')
                    ->where('users.role_id', '=', $role->id)
                    ->get();

        return view('roles.show', compact('role'));
    }
}
