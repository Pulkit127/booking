<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->where('role', 'user')->sortByDesc('id');
        return view('admin.users.index', compact('users'));
    }

    public function show()
    {
        $id = request('id');
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $data =  $request->validated();

        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_picture', 'public');
            $data['profile_picture'] = $imagePath;
        }

        $data['role'] = 'user';
        $data['password'] = bcrypt('123456');
        User::create($data);
        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    public function edit()
    {
        $user_id = request('id');
        $user = User::find($user_id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserRequest $request, $user_id)
    {
        $data =  $request->validated();
        $user = User::find($user_id);

        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_picture', 'public');
            $data['profile_picture'] = $imagePath;
        }

        $user->update($data);
        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function delete()
    {
        $id = request('id');
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }

    public function updateStatus($id, $status)
    {
        $user = User::findOrFail($id);
        $user->status = $status == '1' ? '0' : '1';
        $user->save();
        return redirect()->back()->with('success', 'User status updated successfully.');
    }
}
