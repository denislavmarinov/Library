<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Carbon\Carbon;
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
    public function index ()
    {
        $users = User::get_all_users_with_roles();

        foreach($users as $k => $user)
        {
            if ($user->updated_at !== null)
            {
                $users[$k]->updated_at = Carbon::parse($user->updated_at);
            }
        }

        return view('admin_panel.user_list', compact('users'));
    }
}
