<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SongsInPlaylist extends Model
{
    public $table = 'songs_in_playlist';
    public $primaryKey = 'sip_id';
    protected $guarded = ['sip_id'];

    public function belongsToPlaylist() {
        return $this->hasOne(UserPlaylist::class, 'up_id', 'sip_up_id');
    }

}
