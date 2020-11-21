<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function change_user_role (Request $request)
    {
    	$result = User::change_user_role($request->user_id, $request->new_role);

    	if ($result)
    	{
    		return redirect()->route('roles.index')->with(['message' => 'Successfully canged user role!', 'type' =>'success']);
    	}
    	else
    	{
    		return redirect()->route('roles.index')->with(['message' => 'Something went wrong!!! Please try agin later!', 'type' =>'danger']);
    	}
    }
    public function index ()
    {
        $users = User::get_all_users_with_roles();

        foreach($users as $k => $user)
        {
            if ($user->created_at !== null)
            {
                $users[$k]->created_at = Carbon::parse($user->created_at);
            }
            if ($user->updated_at !== null)
            {
                $users[$k]->updated_at = Carbon::parse($user->updated_at);
            }
        }

        return view('admin_panel.user_list', compact('users'));
    }
    public function require_change_password (Request $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'change' => 1,
            'asked_by' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ];

        $result = User::require_change_password($data);

        if ($result)
        {
            return redirect()->route('users.list')->with(['message' => 'When the user login next time this request will be required!', 'type' =>'success']);
        }
        else
        {
            return redirect()->route('users.list')->with(['message' => 'Something went wrong!!! Please try agin later!', 'type' =>'danger']);
        }
    }

    public function password_update ()
    {
        return view('auth.password_update');
    }

    public function store_new_password(Request $request)
    {

        $this->validate($request, [
            'password' => 'required|min:8|confirmed'
        ]);

        $password = Hash::make($request->password);

        $result = User::update_user_password(Auth::id(), $password);

        if ($result)
        {
            User::remove_from_password_reset_table(Auth::id());
        }
        else
        {
            return redirect()->route('password_update')->with([
                'message' => 'Warning!',
                'type' => 'danger'
            ]);
        }

        return redirect()->route('user_dashboard')->with([
            'message' => 'Successfully updated password!',
            'type' => 'success'
        ]);
    }

    public function change_user_image ()
    {
        return view('user_dashboard.change_user_image');
    }

    public function change_user_image_action (Request $request)
    {
        $extension = $request->file('image')->getClientOriginalExtension();

        if ($extension != 'png' && $extension != 'jpg' && $extension != 'jpeg')
        {
            return redirect()->back()->with([
                'message' => 'File extension is not allowed!!!',
                'type' => 'danger'
            ]);
        }

        Storage::delete( 'public/' . Auth::user()->image );

        $filename = str_replace(' ', '_', Auth::user()->first_name) . str_replace(' ', '_', Auth::user()->last_name) . rand();

        $image_path = $request->file('image')->storeAs('public/user_images', $filename .'.' . $extension);

        $data_to_update = [
            'image' => 'user_images/' . $filename .'.' . $extension
        ];

        $result = User::change_user_profile_image($data_to_update, Auth::id());

        return redirect()->route('user_dashboard')->with(['message' => 'Successfully updated profile image!', 'type' =>'success']);
    }
}
