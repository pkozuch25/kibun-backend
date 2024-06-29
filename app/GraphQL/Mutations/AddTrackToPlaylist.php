<?php

namespace App\GraphQL\Mutations;

use App\Models\SongsInPlaylist;

class AddTrackToPlaylist
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        SongsInPlaylist::create([
            'sip_up_id' => $args['playlistId'],
            'sip_duration_ms' => $args['durationMs'],
            'sip_track_name' => $args['trackName'],
            'sip_artist_name' => $args['artistName'],
            'sip_artist_album_name' => $args['artistAlbumName'],
            'sip_track_image_url' => $args['trackImageUrl'],
        ]);

        return true;
    }
}
