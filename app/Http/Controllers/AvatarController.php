<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class AvatarController extends Controller
{
    public function update(AvatarUpdateRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $path = $request->avatar->store('avatars', 'public');
        // dd($path);


        $user->update([
            'avatar' => $path
        ]);

        return redirect('profile')->with('avatar' , $path);

    }
}
