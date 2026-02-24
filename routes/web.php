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

// Route::get('/admin', [AdminController::class, 'index']);
// Route::post('admin/home-details', [AdminController::class, 'insert'])->name("insert");
// Route::get('/admin/pdf-generator', [AdminController::class, 'pdf'])->name('pdf');
// Route::post('/generate-pdf', [AdminController::class, 'generate'])->name('pdf.generate');
// Route::get("/admin/home-details", [AdminController::class, "home_details"]);


Route::middleware('guest')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('login');
    Route::post('/admin/login', [AdminController::class, 'handleLogin'])->name('admin.login.submit');
});

// Protected Routes (Login ke baad)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // home details route
    Route::get('/home-details', [AdminController::class, 'home_details'])->name('home_details');
    Route::get('/home-details/{id}', [AdminController::class, 'home_details_edit_page'])->name('home_details_edit_page');
    Route::post('/insert-details', [AdminController::class, 'insert'])->name('insert');
    Route::delete('/home-details-delete/{id}', [AdminController::class, 'deleteDetails'])->name('delete_detail');
    Route::put("/home-details-update/{id}", [AdminController::class, 'update'])->name('update_detail');


    // new project
    Route::get('/new-project-details', [AdminController::class, 'new_project_details']);
    Route::post("/new_project_insert", [AdminController::class, 'new_project_insert'])->name('new_project_insert');
    Route::get("/new_project_edit/{id}", [AdminController::class, 'new_project_edit'])->name("new_project_edit");
    Route::put("/new_project_update/{id}", [AdminController::class, 'new_project_update'])->name('new_project_update');
    Route::delete("/new-project-details/{id}", [AdminController::class, 'new_project_delete'])->name("new_project_delete");


    Route::get('/pdf-generator', [AdminController::class, 'pdf'])->name('pdf');
    Route::post('/generate-pdf', [AdminController::class, 'generate'])->name('pdf.generate');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
});
