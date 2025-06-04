<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            return redirect()->intended('/boss');
        }
        
        return redirect()->intended('/lk');
    }
} 