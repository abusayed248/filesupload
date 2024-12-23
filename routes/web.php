<?php

use App\Http\Controllers\Auth\MagicLinkController;
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




Route::get('/', function () {
    return view('home');
});
Route::get('/', function () {return view('home');});
Route::post('/send-magic-link', [MagicLinkController::class, 'sendMagicLink'])->name('magic-link.send');
Route::get('/magic-login/{token}', [MagicLinkController::class, 'loginWithMagicLink'])->name('magic-link.login');
Route::get('/magic-view}', [MagicLinkController::class, 'magiLinkView'])->name('login');
Route::middleware('auth:sanctum')->get('/contact', [MagicLinkController::class, 'contactView'])->name('contact');
Route::middleware('auth:sanctum')->post('logout', [MagicLinkController::class, 'destroy']) ->name('logout');

