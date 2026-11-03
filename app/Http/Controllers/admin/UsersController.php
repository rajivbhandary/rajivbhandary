<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $this->authorize('create', User::class);

        $image = $request->file('image')->store('users');
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'facebook_id' => $request->facebook_id,
            'twitter_id' => $request->twitter_id,
            'instagram_id' => $request->instagram_id,
            'behance_id' => $request->behance_id,
            'youtube_id' => $request->youtube_id,
            'linked_in_id' => $request->linked_in_id,
            'about' => $request->about,
            'password' => Hash::make($request->password),
            'image' => $image
        ]);

        session()->flash('success', "User was created Successfully!");
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('profileUpdate', $user);
        return view('admin.users.edit', compact([
            'user'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('profileUpdate', $user);
        $data = $request->only(['name', 'email', 'phone_number', 'about', 'facebook_id', 'twitter_id', 'behance_id', 'instagram_id', 'youtube_id', 'linked_in_id']);
        if($request->hasFile('image')){
            $image = $request->image->store('users');
            $user->deleteImage();
            $data['image'] = $image;
        }
        $user->update($data);

        session()->flash('success', "Profile was updated Successfully");
        return redirect(route('admin.dashboard'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $user);
        $user->deleteImage();
        foreach ($user->blogs as $blog){
            $blog->deleteImage();
        }
        $user->forceDelete();
        session()->flash('success', 'User was deleted Successfully!');
        return redirect()->back();
    }

    public function trash(User $user){
        $this->authorize('delete', $user);
        $user->delete();
        return redirect(route('frontend.index'));
    }

    public function trashed(){
        $trashed = User::onlyTrashed();
        return view('admin.users.trashed', compact([
            'trashed',
        ]));
    }

    public function restore($id){
        $trashedUser = User::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $trashedUser);
        $trashedUser->restore();
        session()->flash('success', 'User was restored Successfully!');
        return redirect(route('users.index'));
    }
}
