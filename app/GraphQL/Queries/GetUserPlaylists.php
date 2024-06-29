<?php

namespace App\GraphQL\Queries;

use App\Models\UserPlaylist;
use Illuminate\Support\Facades\Auth;

class GetUserPlaylists
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        return UserPlaylist::where('up_user_id', Auth::id())->withCount('tracksInPlaylist');
    }
}
