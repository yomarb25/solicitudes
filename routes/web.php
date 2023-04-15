<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('download', function(){
    return response()->download( App\Models\Solicitude::first()->getFirstMedia('dpi')->getPath());
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('solicitudes', ['App\Http\Controllers\SolicitudeController', 'store'])->middleware(['role:normal']);
    Route::get('solicitudes', ['App\Http\Controllers\SolicitudeController', 'index']);
    Route::get('solicitudes/{solicitude}', ['App\Http\Controllers\SolicitudeController', 'show']);
    Route::put('solicitudes/{solicitude}', ['App\Http\Controllers\SolicitudeController', 'update'])->middleware(['role:tecnico']);
});

Route::middleware('auth:sanctum')->get('user', function(){
    $user = auth()->user();
    $user->role = $user->roles->first()->name;
    return $user;
});

Route::any('{all}', function () {
    return view('layouts.app');
})
->where(['all' => '.*']);
