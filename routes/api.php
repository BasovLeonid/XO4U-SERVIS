<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users/search', function (Request $request) {
    $query = $request->get('q');
    if (strlen($query) < 2) {
        return response()->json([]);
    }

    return \App\Models\User::where('name', 'like', "%{$query}%")
        ->select('id', 'name')
        ->limit(10)
        ->get();
}); 