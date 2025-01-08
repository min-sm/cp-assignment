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
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'confirm-password' => ['required', 'same:password']
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
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
        $user = User::firstOrCreate([
            'email' => $githubUser->email
        ], [
            'name' => $githubUser->name,
            'password' => Hash::make(Str::random(24))
        ]);

        Auth::login($user, true);
        Log::channel('registration')->info('New user registered via GitHub: ' . $githubUser->email);
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
