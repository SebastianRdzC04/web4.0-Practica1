<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
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

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
