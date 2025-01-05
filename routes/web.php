<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Backend\FileUploadController;
use App\Http\Controllers\Backend\Auth\MagicLinkController;
use App\Http\Controllers\TermsController;

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





Route::middleware(['auth'])->group(function () {

    Route::get('admin/privacy-policy', [PolicyController::class, 'show'])->name('privacy-policy.index');
    Route::get('/admin/privacy-policy/edit', [PolicyController::class, 'edit'])->name('policy.edit');
    Route::post('/admin/privacy-policy/edit', [PolicyController::class, 'update'])->name('policy.update');


    Route::get('admin/terms', [TermsController::class, 'show'])->name('terms.index');
    Route::get('/admin/terms/edit', [TermsController::class, 'edit'])->name('terms.edit');
    Route::post('/admin/terms/edit', [TermsController::class, 'update'])->name('terms.update');

    Route::get('/admin/contact', [ContactController::class, 'editContact'])->name('contact.index');
    Route::get('/admin/contact/edit', [ContactController::class, 'edit'])->name('contact.edit');
    Route::post('/admin/contact', [ContactController::class, 'updateContact'])->name('contact.update');
});


Route::get('/', function () {
    return view('home');
    // \Artisan::call('storage:link');
})->name('home');

Route::post('/send-magic-link', [MagicLinkController::class, 'sendMagicLink'])->name('magic-link.send');
Route::get('/magic-login/{token}', [MagicLinkController::class, 'loginWithMagicLink'])->name('magic-link.login');



Route::middleware('guest')->group(function () {
    Route::get('/magic-view', [MagicLinkController::class, 'magiLinkView'])->name('login');
});

Route::get('/logout', function () {
    return redirect('magic-view');
})->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::middleware('auth.redirect')->post('/logout', [MagicLinkController::class, 'destroy'])->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('all-files', [UploadController::class, 'showFilesByFolder'])->name('files.index');
    Route::get('/files/download/{filePath}', [UploadController::class, 'downloadFile'])->name('files.download');

    Route::get('files2333', [UploadController::class, 'showFilesByFolder'])->name('upload.index');

    Route::get('/files/download/{filePath}', [UploadController::class, 'downloadFile'])->name('files.download');

    Route::get('admin/folder-files', [UploadController::class, 'showAllFileFolder'])->name('allfiles.index');

    Route::delete('files/{fileId}/delete', [UploadController::class, 'deleteFile'])->name('files.delete');
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

Route::post('/subscription/check', [UploadController::class, 'check'])->name('subscription.check');

Route::post('/download-zip', [UploadController::class, 'downloadZip'])->name('download.zip');
Route::get('/download-zip', [UploadController::class, 'downloadZip'])->name('download.zip');

Route::get('/payment', [UploadController::class, 'showPaymentPage'])->name('payment.page');
Route::post('/subscription/create', [UploadController::class, 'createSubscriptions'])->name('subscription.create');


Route::get('upload', [UploadController::class, 'index'])->name('upload.index');
Route::post('upload', [UploadController::class, 'store'])->name('upload.store');
Route::post('/store-filepaths', [UploadController::class, 'storeFilePaths'])->name('store.filepaths');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/terms', [ContactController::class, 'terms'])->name('terms');
Route::get('/privacy', [ContactController::class, 'privacy'])->name('privacy');
Route::get('/force-download', [UploadController::class, 'forceDownload'])->name('force.download');

// contact route
Route::post('/message-send', [ContactController::class, 'sendMsg'])->name('contact.msg.send');

// update contact info
Route::middleware(['contact.access'])->group(function () {
    Route::get('admin/update-contact-info', [ContactController::class, 'updateContactInfo'])->name('update.contact.info');
    Route::post('/update-contact-info', [ContactController::class, 'updateContactInfoStatus'])->name('update.company.status');
});
