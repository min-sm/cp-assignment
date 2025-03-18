<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'confirm-password' => ['required', 'same:password']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Log::channel('auth')->info('New user registered: ' . $user->email);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            Log::channel('auth')->info('User logged in: ' . $request->email);
            return redirect('/');
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Log::channel('auth')->warning('Login attempt with non-existent email: ' . $request->email);
            throw ValidationException::withMessages([
                'email' => 'Email not found.',
            ]);
        } else {
            Log::channel('auth')->warning('Failed login attempt for user: ' . $request->email);
            throw ValidationException::withMessages([
                'password' => 'Incorrect password.',
            ]);
        }
    }

    public function githubCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        if (!$githubUser->email) {
            return redirect()->route('login')->with('error', 'GitHub account does not have an email address.');
        }

        $name = $githubUser->name ?? $githubUser->nickname;

        $user = User::updateOrCreate([
            'email' => $githubUser->email
        ], [
            'name' => $name,
            'password' => Hash::make(Str::random(24))
        ]);

        Auth::login($user, true);
        Log::channel('auth')->info('New user registered via GitHub: ' . $githubUser->email);
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showAdminLoginForm()
    {
        return view('admin.auth.login');
    }

    public function adminLogin(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Extract credentials and remember me flag
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials, $remember)) {
            // Check if the authenticated user has the 'admin' role
            if (Auth::user()->role === 'admin') {
                Log::channel('auth')->info('Admin logged in: ' . $request->email);
                return redirect()->route('admin.dashboard');
            } else {
                // Log out the user if they are not an admin
                Auth::logout();
                Log::channel('auth')->warning('Non-admin user attempted to log in: ' . $request->email);
                throw ValidationException::withMessages([
                    'email' => 'You do not have permission to access the admin area.',
                ]);
            }
        }

        // If authentication fails, check if the email exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Log::channel('auth')->warning('Admin login attempt with non-existent email: ' . $request->email);
            throw ValidationException::withMessages([
                'email' => 'Email not found.',
            ]);
        } else {
            Log::channel('auth')->warning('Failed admin login attempt for user: ' . $request->email);
            throw ValidationException::withMessages([
                'password' => 'Incorrect password.',
            ]);
        }
    }
}
