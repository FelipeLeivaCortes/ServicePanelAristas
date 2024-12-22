<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * This function mark as read the notification, then redirect to the target route
     * 
     * @param Request $request (Required): Target route
     */
    public function mark_as_read(Request $request)
    {
        $request->validate([
            'notification_id'   => 'required',
            'target_route'      => 'required',
        ]);

        $notification    = User::find(Auth::user()->id)->unreadNotifications->where('id', $request->notification_id);
        $notification->markAsRead();

        return redirect()->route($request->target_route);
    }

    public function all(User $user)
    {
        return $user;
    }
}
