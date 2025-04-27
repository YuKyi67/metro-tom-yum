<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;


class RegisteredUserController extends Controller
{
    public function index() {
        Gate::authorize('viewAny', User::class);

        // get the current user type
        $currentUserType = Auth::user()->role;

    if ($currentUserType == 'staff') {
        $users = User::where('role', '!=', 'admin')->paginate(10); // Exclude admins
    } else {
        $users = User::paginate(10);
    }
        return view('admin.users', ['users' => $users]);
    }

    /*
     Display the registration view.
     */
    public function create(): View
    {

        if(Auth::guest()) {
            return view('auth.register');
        }

        // not authorized if not admin
        Gate::authorize('create', User::class);

        return view('admin.create');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Check if the user is authenticated and is allowed to create users
        if (Auth::check() && !Gate::allows('create', User::class)) {
            throw new AuthorizationException("You are not authorized to perform this action.");
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['nullable', 'in:admin,staff,user'], // Role is optional, see migration file for type
        ]);

        // if not provided, default to user
        $role = $request->role ?? 'user';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $role,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // if admin is creating user
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect(route('users.index', absolute: false));
        }

        Auth::login($user);

        // For guests, redirect to the dashboard after registration
        return redirect(route('dashboard', absolute: false));
    }
}
