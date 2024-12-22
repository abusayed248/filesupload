<?php

use App\Http\Controllers\Backend\Auth\MagicLinkController;
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
Route::get('/login', [MagicLinkController::class, 'login']);
Route::post('/login', [MagicLinkController::class, 'store'])->name('login');
