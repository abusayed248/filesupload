<?php

use App\Http\Controllers\Auth\MagicLinkController;
use App\Http\Controllers\ContactController;
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
})->name('home');

Route::post('/send-magic-link', [MagicLinkController::class, 'sendMagicLink'])->name('magic-link.send');
Route::get('/magic-login/{token}', [MagicLinkController::class, 'loginWithMagicLink'])->name('magic-link.login');



Route::middleware('guest')->group(function () {
    Route::get('/magic-view', [MagicLinkController::class, 'magiLinkView'])->name('login');
});

Route::get('/logout', function () {
    return redirect('magic-view');
})->middleware('guest');

Route::middleware('auth')->group(function() {
    Route::middleware('auth.redirect')->post('/logout', [MagicLinkController::class, 'destroy']) ->name('logout');
});


Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/dmca', [MagicLinkController::class, 'dmca'])->name('dmca');
Route::get('/terms', [ContactController::class, 'terms'])->name('terms');
Route::get('/privacy', [ContactController::class, 'privacy'])->name('privacy');