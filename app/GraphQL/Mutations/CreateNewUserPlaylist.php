<?php

namespace App\GraphQL\Mutations;

use App\Models\UserPlaylist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CreateNewUserPlaylist
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {

        /** @var \Illuminate\Http\UploadedFile $file */

            $file = $args['image'];

            $uploaded = Storage::disk('public')->put('user' . Auth::id() . '/' . $args['name'], $file);
            if ($uploaded) {
                UserPlaylist::create([
                    'up_name' => $args['name'],
                    'up_image_url' => 'https://kibun.w66024.pl'. '/' . $uploaded,
                    'up_user_id' => Auth::id()
                ]);
        return true;
    }
}
}
