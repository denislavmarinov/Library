<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // All notifications that user has not seen yet
        $notifications = Notification::get_all_unreaded_notifiactions_for_user(Auth::id());

        return view('user_dashboard.user_dashboard', compact('notifications'));
    }

    public function notification_seen ($notification_id)
    {
        $data_to_update = [
            'seen' => 1,
        ];

       $result = Notification::notification_mark_as_seen($data_to_update, $notification_id, Auth::id());

       if ($result > 0)
       {
        echo true;
       }
       else
       {
        echo false;
       }
    }

    public function mark_all_notifications_as_seen ()
    {
        $data_to_update = [
            'seen' => 1,
        ];

       $result = Notification::mark_all_notifications_as_seen($data_to_update,  Auth::id());

       if ($result > 0)
       {
        echo true;
       }
       else
       {
        echo false;
       }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('notifications.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
