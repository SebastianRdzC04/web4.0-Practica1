<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('pages.users');
    }

    public function stats()
    {
        return view('pages.stats');
    }

    public function getAllUsers()
    {
        $users = User::with('personalData')->paginate(10);

        return view('pages.welcome', compact('users'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:2|confirmed',
            'age' => 'required|integer|min:1|max:120',
            'gender'=> 'required|in:Hombre,Mujer',
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role_id' => 2, // Assuming 2 is the role ID for clients
        ]);
        $user->personalData()->create([
            'age' => $validated['age'],
            'gender' => (($validated['gender'] == 'Hombre') ? 'male' : 'female'),
        ]);


        return back()->with('success', 'Usuario creado');
    }

    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Usuario eliminado');
    }
}
