<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountPasswordsController extends Controller
{
    public function changePassword()
    {
        $this->authorize('updatePassword', auth()->user());
        return view('admin.users.change-password');
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $this->authorize('updatePassword', auth()->user());
        auth()->user()->password = Hash::make($request->password);
        auth()->user()->save();

        session()->flash('success', "Password was updated Successfully");
        return redirect(route('admin.dashboard'));
    }
}
