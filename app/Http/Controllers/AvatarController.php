<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarUpdateRequest;
use Illuminate\Http\RedirectResponse;

class AvatarController extends Controller
{
    public function update(AvatarUpdateRequest $request): RedirectResponse
    {
        try {
            $user = auth()->user();
            $path = $request->avatar->store('avatars', 'public');
            // dd(url('storage/' . $user->avatar));

            $user->update([
                'avatar' => 'storage/' . $path
            ]);

            return redirect('profile')->with('avatar', $path);
        } catch (\Throwable $e) {
            $e->getMessage();
            return back()->with('error', $e->getMessage());
        }
    }
}
