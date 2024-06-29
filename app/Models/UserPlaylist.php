<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserPlaylist extends Model
{
    public $table = 'user_playlists';
    public $primaryKey = 'up_id';
    protected $guarded = ['up_id'];

    public function user() {
        return $this->hasOne(User::class, 'id', 'up_user_id');
    }

    public function tracksInPlaylist() {
        return $this->hasmany(SongsInPlaylist::class, 'up_id', 'sip_up_id');
    }

}
