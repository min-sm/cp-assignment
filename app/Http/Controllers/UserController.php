<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::where('role', 'customers')->paginate(10);
        $admins = User::where('role', 'admin')->get();
        return view('admin.users.index', compact('customers', 'admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'confirm-password' => ['required', 'same:password'],
            'phone_number' => ['nullable'],
            'address' => ['nullable'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'phone_number' => $request->phone_number,
            'address' => $request->address,

        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Registration successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function adminEdit(User $user)
    {
        // $id = Auth::id();
        // dd($id);
        // $user = User::findOrFail($id);
        // dd($user->name);
        return view('admin.users.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function adminUpdate(Request $request)
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255'],
        //     'phone_number' => ['nullable'],
        //     'address' => ['nullable'],
        // ]);

        $user = User::findOrFail(Auth::id());

        $user->update([
            'password' => $request->password,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Profile updated successfully');
    }
}
