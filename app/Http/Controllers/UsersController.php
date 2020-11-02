<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function change_user_role (Request $request)
    {
    	$result = User::change_user_role($request->user_id, $request->new_role);

    	if ($result)
    	{
    		return redirect()->route('roles.index')->with('message', 'Successfully canged user role!');
    	}
    	else
    	{
    		return redirect()->route('roles.index')->with('message', 'Something went wrong!!! Please try agin later!');
    	}
    }
}
