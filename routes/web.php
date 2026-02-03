<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntellatualController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about-us', [HomeController::class, 'about'])->name('about-us');
Route::get('/certificate', [HomeController::class, 'certificate'])->name('certificate');

// API/Action Routes
Route::post('/check-userid', [HomeController::class, 'checkUserId'])->name('check_userId');
Route::get('/download/{user_id}', [HomeController::class, 'downloadPdf'])->name('download_pdf');

// admin

Route::get('/admin', [AdminController::class, 'index']);
Route::post('admin', [AdminController::class, 'insert']);
Route::get('/admin/pdf-generator', [AdminController::class, 'pdf'])->name('pdf');
Route::post('/generate-pdf', [AdminController::class, 'generate'])->name('pdf.generate');
Route::get("/admin/home-details", [AdminController::class, "home_details"]);
Route::get('/admin/new-project-details', [AdminController::class, 'new_project_details']);

