<?php

namespace App\Http\Controllers\Boss;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('boss.dashboard');
    }

    public function users()
    {
        $users = User::select([
            'id',
            'name',
            'email',
            'phone',
            'telegram_username',
            'role',
            'is_partner',
            'balance',
            'total_spent',
            'repeat_purchases',
            'payment_rating'
        ])->latest()->paginate(10);
        
        return view('boss.users.index', compact('users'));
    }
} 