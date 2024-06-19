<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\UserFailedLogin;
use Illuminate\Validation\ValidationException;

class LoginService
{
    public $lastLogin;

    public function lastLoginModeration($device)
    {
        if (!$this->lastLogin) {
            $this->lastLogin = new UserFailedLogin();
            $this->lastLogin->ufla_failed_attempts = 0;
            $this->lastLogin->ufla_device_name = $device;
            $this->lastLogin->save();
        }
    }

    public function saveFailedLoginAttempt($deviceName)
    {
        if ($this->lastLogin?->ufla_failed_attempts < 5) {
            $this->lastLogin->update(['ufla_device_name' => $deviceName, 'ufla_last_attempt' => Carbon::now()]);
            $this->lastLogin->increment('ufla_failed_attempts', 1);
        }
    }

    public function timeoutDevice()
    {
        if (Carbon::parse($this->lastLogin->ufla_last_attempt)->diffInSeconds(Carbon::now(), false) > 300) {
            $this->lastLogin->update(['ufla_failed_attempts' => 0]);
        }
        if ($this->lastLogin?->ufla_failed_attempts == 5) {
            $timeout = round(Carbon::now()->diffInSeconds(Carbon::parse($this->lastLogin->ufla_last_attempt)->addMinutes(5), false));
            if ($timeout > 0) {
                throw ValidationException::withMessages([
                    'login' => ["Too many login attempts, try again in $timeout seconds"]
                ]);
                return;
            }
            $this->lastLogin->update(['ufla_failed_attempts' => 0]);
        }
    }
}
