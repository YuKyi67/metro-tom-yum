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
    public function edit(User $user): View
    {
        // Check if the user is authorized to edit the profile
        if (Auth::user()->id !== $user->id && Auth::user()->role == 'user') {
            abort(403, 'Unauthorized action.');
        }

        return view('profile.edit', [
            // 'user' => $request->user(),
            'user' => $user
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
{
    if (Auth::user()->id !== $user->id && !in_array(Auth::user()->role, ['admin', 'staff'])) {
        abort(403, 'Unauthorized action.');
    }

    $user->fill($request->validated());

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    return Redirect::route('profile.edit', $user)->with('status', 'profile-updated');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => [in_array(Auth::user()->role, ['admin', 'staff']) ? 'nullable' : 'required', 'current_password'],
        ]);

        // if current user
        if (in_array(Auth::user()->role, ['admin', 'staff'])) {
            $user->delete();

            return Redirect::route('users.index');
        } else {
            // Logout current user
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $user->delete();

            return Redirect::to('/');
        }
    }
}
