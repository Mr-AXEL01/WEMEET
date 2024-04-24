<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateInformationRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        return Inertia::render('Profile/view', [
            'status' => session('status'),
            '$success' => session('$success'),
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
        $success = '';
        if($cover) {
            if ($user->cover_path) {
                Storage::disk('public')->delete($user->cover_path);
            }
            $path = $cover->store('user-'.$user->id, 'public');
            $user->update(['cover_path' => $path]);
            $success = 'Your cover was been updated';
        }
        if($avatar) {
            if ($user->avatar_path) {
                Storage::disk('public')->delete($user->avatar_path);
            }
            $path = $avatar->store('user-'.$user->id, 'public');
            $user->update(['avatar_path' => $path]);
            $success = 'Your avatar was been updated';
        }

        return back()->with('success', $success);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateInformationRequest $request)
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return to_route('profile', $request->user())->with('success', 'Your profile details were updated.');
    }
}
