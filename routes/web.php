<?php

use App\Http\Controllers\UploadController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Dashboard;
use App\Livewire\EditCertificate;
use App\Livewire\EditTranning;
use App\Livewire\ListStudent;
use App\Livewire\Profile;
use App\Livewire\Trannings;
use App\Livewire\ViewCertificate;
use Illuminate\Support\Facades\Route;

Route::get('/', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/trannings', Trannings::class)->name('trannings');
    Route::get('/edit-tranning-{id}', ListStudent::class)->name('edit_traning');
    Route::get('/edit-certificate-{id}', EditCertificate::class)->name('edit_certificate');
    Route::get('/view-certificate-{id}', ViewCertificate::class)->name('view_certificate');
    Route::get('/mail', EditTranning::class)->name('mail');
    Route::get('/profile', Profile::class)->name('profile');
    Route::post('/upload-file-image', [UploadController::class, 'uploadImage'])->name('upload_image');
    Route::post('/send-mail', [EditTranning::class, 'sendCertificates'])->name('send_mail');
    Route::post('/edit-certi', [EditCertificate::class, 'save'])->name('save_certificate');
    Route::get('/logout', function(){
        auth()->logout();

        return redirect()->route('login');
    })->name('logout');

});
