<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Backend\FileUploadController;
use App\Http\Controllers\Backend\Auth\MagicLinkController;

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
Route::get('/login', [MagicLinkController::class, 'login']);
Route::post('/login', [MagicLinkController::class, 'store'])->name('login');

Route::get('/login/token/{token}', [MagicLinkController::class, 'loginWithToken'])->name('login.token');
Route::post('/send-login-link', [MagicLinkController::class, 'sendLoginLink'])->name('send-login-link');

Route::get('/upgrade', [FileUploadController::class, 'showUpgradePage'])->name('upgrade');
Route::post('/upload', [FileUploadController::class, 'upload'])->name('upload');
Route::post('/api/upload-details', [FileUploadController::class, 'upload']);
Route::get('/download', [FileUploadController::class, 'download'])->name('file.download');
Route::get('get/download/{file}', [FileUploadController::class, 'getDownload'])->name('get.download');
Route::get('/download/{file}', [FileUploadController::class, 'getDownloadNew'])->name('get.download');
Route::get('/get-upload-progress/{batchId}', [FileUploadController::class, 'getUploadProgress']);



Route::get('get/link/{file}', [FileUploadController::class, 'getDownloadLink'])->name('get.link');




Route::get('upload', [UploadController::class, 'index'])->name('upload.index');
Route::post('upload', [UploadController::class, 'store'])->name('upload.store');
Route::post('/store-filepaths', [UploadController::class, 'storeFilePaths'])->name('store.filepaths');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/dmca', [MagicLinkController::class, 'dmca'])->name('dmca');
Route::get('/terms', [ContactController::class, 'terms'])->name('terms');
Route::get('/privacy', [ContactController::class, 'privacy'])->name('privacy');
