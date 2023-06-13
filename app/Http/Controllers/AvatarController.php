<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use OpenAI\Laravel\Facades\OpenAI;

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

    public function generate(): RedirectResponse
    {
        $response = OpenAi::images()->create([
            'prompt' => 'A laravel web developer avatar',
            'n' => 1,
            'size' => '256x256',
            'response_format' => 'url',
        ]);

        // Get the image contents
        $avatar = file_get_contents($response->data[0]->url);

        $user = auth()->user()->id;

        Storage::disk('public')->put('avatars/' . $user . '.png' , $avatar);
        auth()->user()->update([
            'avatar' => 'storage/avatars/' . $user . '.png',
        ]);

        return redirect('profile')->with('avatar', 'storage/avatars/' . $user . '.png');
    }
}
