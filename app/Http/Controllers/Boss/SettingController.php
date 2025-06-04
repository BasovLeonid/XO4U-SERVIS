<?php

namespace App\Http\Controllers\Boss;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('boss.settings.index');
    }

    public function update(Request $request)
    {
        // Здесь будет логика обновления настроек
        return redirect()->route('boss.settings')
            ->with('success', 'Настройки успешно обновлены');
    }
} 