<?php

namespace App\Http\Controllers\Boss;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        return view('boss.api.index');
    }

    public function updateYandexDirect(Request $request)
    {
        // Логика обновления настроек Яндекс.Директ
    }

    public function updateYandexMetrika(Request $request)
    {
        // Логика обновления настроек Яндекс.Метрики
    }

    public function yandexYookassa()
    {
        // Логика получения настроек ЮKassa
    }

    public function updateYandexYookassa(Request $request)
    {
        // Логика обновления настроек ЮKassa
    }
} 