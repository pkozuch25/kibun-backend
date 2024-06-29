<?php

namespace App\GraphQL\Queries;

use App\Models\SongsInPlaylist;

class GetUserSongsInPlaylist
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        return SongsInPlaylist::where('sip_up_id', $args['playlistId']);
    }
}
