<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;

class AvatarController extends Controller
{
    public function __invoke(Request $request)
    {
        $colors = ['#2F855A', '#2C7A7B', '#2B6CB0', '#4A5568'];

        $avatar = new InitialAvatar();

        return $avatar->name($request->for ?? 'Unknown')
            ->background(Arr::random($colors))
            ->color('#fff')
            ->length(1)
            ->generate()
            ->stream('png', 100);
    }
}
