<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use App\Services\LoginService;
use App\Models\UserFailedLogin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Login extends LoginService
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::email($args['email'])->first();
        $this->lastLogin = UserFailedLogin::where('ufla_device_name', $args['device'])->first();
        $this->lastLoginModeration($args['device']);

        $this->timeoutDevice();

        if (!$user) {
            $this->saveFailedLoginAttempt($args['device']);
            throw ValidationException::withMessages([
                'email' => ['No such user in database'],
            ]);
        }
        if (!Hash::check($args['password'], $user->password)) {
            $this->saveFailedLoginAttempt($args['device']);
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }


        return $user->createToken($args['email'])->plainTextToken;
    }
}
