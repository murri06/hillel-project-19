<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserController extends Controller
{

    public function list(): View
    {
        return view('users.list', [
            'users' => User::all()
        ]);
    }

    public function details($id): View
    {
        $user = User::query()->findOrFail($id);
        return view('users.details', [
            'user' => $user,
            'events' => $user->events,
        ]);
    }

    public function addUser(Request $request): RedirectResponse
    {
        $check = trim($request->input('email'));
        if (User::query()->where('email', $check)->count() > 0) {
            return to_route('users_create', ['errNo' => '1']);
        }
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'email_verified_at' => now(),
            'password' => Hash::make($request->input('password')),
            'remember_token' => Str::random(10),
        ]);
        $user->save();
        return to_route('users_list');
    }

    public function editUserForm($id): View
    {
        return view('users.create', [
            'user' => User::query()->findOrFail($id),
        ]);
    }

    public function editUser($id, Request $request): RedirectResponse
    {
        $checkEmail = trim($request->input('email'));
        if (User::query()->where('email', $checkEmail)->whereNot('id', $id)->count() > 0) {
            return to_route('users.edit', ['errNo' => '1']);
        }

        $user = User::query()->findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'email_verified_at' => now(),
            'password' => Hash::make($request->input('password')),
        ]);
        return to_route('users_list');
    }

    public function deleteUser($id): RedirectResponse
    {
        $user = User::query()->findOrFail($id);
        $user->delete();
        return to_route('users_list');
    }
}
