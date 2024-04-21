<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $username = $this->generateUsername($request->name);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $username,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    private function generateUsername($name)
    {
        $cleanedName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $name));
        $truncatedName = substr($cleanedName, 0, 10);
        $username = $truncatedName;
        $suffix = 1;
        while (User::where('username', $username)->exists()) {
            $username = $cleanedName . $suffix++;
        }

        return $username;
    }
}
