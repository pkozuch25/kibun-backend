<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserFailedLogin extends Model
{
    public $table = 'user_failed_login_attempts';
    public $primaryKey = 'ufla_id';
    protected $guarded = ['ufla_id'];

}
