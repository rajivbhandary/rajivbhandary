<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Notifications\AdminRightNotification;
use App\User;
use Illuminate\Http\Request;

class AdminRightsController extends Controller
{
    public function makeAdmin(User $user) {
        $this->authorize('makeAdmin', $user);
        $user->role = "admin";
        $user->save();
        $user->notify(new AdminRightNotification($user));
        session()->flash('success', $user->name . ' has been made an admin!');
        return redirect(route('users.index'));
    }

    public function revokeAdmin(User $user) {
        $this->authorize('revokeAdmin', $user);
        $user->role = "author";
        $user->save();
        $user->notify(new AdminRightNotification($user));
        session()->flash('success', $user->name . ' has been revoked as an admin!');
        return redirect(route('users.index'));
    }
}
