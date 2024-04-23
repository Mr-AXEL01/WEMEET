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
            'status' => session('status'),
            'user' => new UserResource($user)
        ]);
    }

    public function updateImage(Request $request)
    {
        $data = $request->validate([
            'cover' => ['nullable','image'],
            'avatar' => ['nullable','image'],
        ]);

        $user = $request->user();

        $avatar = $data['avatar'] ?? null;

        /**  @var \Illuminate\Http\UploadedFile $cover */

        $cover = $data['cover'] ?? null;

        if($cover) {
            $path = $cover->store('covers/'.$user->id, 'public');
            $user->update(['cover_path' => $path]);
        }
        session('success','Cover image has been updated successfully');

        return back()->with('status', 'cover-update');
    }
}
