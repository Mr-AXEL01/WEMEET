<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        return Inertia::render('Profile/view', [
            'user' => new UserResource($user)
        ]);
    }

    public function updateImage(Request $request)
    {
        $data = $request->validate([
            'cover' => ['nullable','image'],
            'avatar' => ['nullable','image'],
        ]);
        dd($data);
    }
}
