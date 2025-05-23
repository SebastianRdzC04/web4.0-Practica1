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
            'age' => 'required|integer|min:1|max:120',
            'gender'=> 'required|in:Hombre,Mujer',
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt('1234567890'),
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
        if ($user->id == auth()->user()->id) {
            return back()->with('error', 'No puedes eliminar tu propio usuario');
        }

        $user->delete();

        return back()->with('success', 'Usuario eliminado');
    }
    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,'.$user->id,
            'age' => 'nullable|integer|min:0|max:120',
            'gender' => 'nullable|in:male,female',
        ]);

        // Filtrar datos vacíos
        $userData = array_filter([
            'name' => $validatedData['name'] ?? null,
            'email' => $validatedData['email'] ?? null,
        ], function($value) {
            return $value !== null && $value !== '';
        });

        // Actualizar usuario si hay datos
        if (!empty($userData)) {
            $user->update($userData);
        }

        // Actualizar datos personales si hay datos
        if (isset($validatedData['age']) || isset($validatedData['gender'])) {
            $personalData = $user->personalData;

            if (isset($validatedData['age']) && $validatedData['age'] !== '') {
                $personalData->age = $validatedData['age'];
            }

            if (isset($validatedData['gender']) && $validatedData['gender'] !== '') {
                $personalData->gender = $validatedData['gender'];
            }

            $personalData->save();
        }

        return back()->with('success', 'Profile updated successfully');
    }
    public function getUser($id)
    {
        $user = User::with('personalData')->findOrFail($id);

        return view('pages.edit-user', compact('user'));
    }
}
