<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(["data" => $users]);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'username' => ['required', 'string', 'min:3', 'unique:users'],
            'email' => ['required', 'string', 'email', 'lowercase', 'unique:users'],
            'password' => ['required', 'string'],
            'role' => ['string']
        ]);

        $user = User::create($validated);
        return response()->json(["success" => "User created successfuly", "data" => $user], 201);
    }

    public function update(string $id, Request $request)
    {
        $validated = $request->validate([
            'username' => ['string', 'min:3', 'unique:users'],
            'email' => ['string', 'email', 'lowercase', 'unique:users'],
            'password' => ['string'],
            'role' => ['string'],
        ]);
        $user = User::find($id);

        if ($user) {
            $user->update($validated);
            return response()->json(["success" => "User updated successfuly", "data" => $user], 202);
        }

        return response()->json(["error" => "User not found"], 404);
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(["success" => "User deleted successfuly"]);
        } else return response()->json(["error" => "User not found"]);
    }
}
