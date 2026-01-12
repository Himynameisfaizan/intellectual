<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntellatualController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/pdf', [HomeController::class, 'pdf'])->name('pdf');
Route::get('/about-us', [HomeController::class, 'about'])->name('about-us');
Route::get('/certificate', [HomeController::class, 'certificate'])->name('certificate');
Route::get('/test', [HomeController::class, 'test']);

// API/Action Routes
Route::post('/check-userid', [HomeController::class, 'checkUserId'])->name('check_userId');
Route::get('/download/{user_id}', [HomeController::class, 'downloadPdf'])->name('download_pdf');

// admin

Route::get('admin', [AdminController::class, 'index']);
Route::post('admin', [AdminController::class, 'insert']);