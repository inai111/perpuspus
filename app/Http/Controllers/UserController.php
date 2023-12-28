<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = request('search');
        $users = User::where(function($q)use($query) {
            $q->where('name','like',"%{$query}%")
            ->orWhere('email','like',"%{$query}%");
        })
        ->where('role_id',2)->with('role')
        ->paginate(5)->appends(request()->query());

        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'role_id' => 'required|exists:roles,id',
            'password'=>'required|min:6|max:8|string|confirmed'
        ]);
        User::create($validate);

        return redirect(route('user.index'))->with(['message' => "user created successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = User::find($id);
        return view('users.show',compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = User::find($id);
        $roles = Role::all();
        return view('users.edit',compact('roles','member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function setting()
    {
        $user = User::find(auth()->user()->id);
        return view('users.setting', compact('user'));
    }
    public function settingupdate(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $validate = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email,'.$user->id.',id',
            'password'=>'nullable|min:6|max:8|string|confirmed'
        ]);

        $validate = Arr::whereNotNull($validate);

        $user->update($validate);
        return redirect()->back()->with(['message'=>'User Updated']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = User::find($id);

        $validate = $request->validate([
            'name' => 'required|string',
            'email'=>'required|email|unique:users,email,'.$member->id.',id',
            'role_id' => 'required|exists:roles,id',
            'password'=>'nullable|min:6|max:8|string|confirmed'
        ]);
        $member->update($validate);

        return redirect(route('user.index'))->with(['message' => "user updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
