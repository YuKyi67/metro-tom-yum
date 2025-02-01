<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        // register the policy
        Gate::authorize('viewAny', User::class);

        $users = User::all(); // need to solve n+1 problem

        return view('admin.users', ['users' => $users]);
    }

    /**
     * Display the registration view.
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

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function adminStore(Request $request): RedirectResponse
    {
        Gate::authorize('create', User::class);

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

        // go back to user route when successful
        return redirect(route('users.index', absolute: false));
    }
}
