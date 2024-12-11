<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\CvReviewController;
use App\Http\Controllers\InterviewController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('admin.pages.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// -------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix("user")->name("user.")->group(function () {
        Route::get("/", [UserController::class, 'index'])->name('index');
        Route::get("/create", [UserController::class, 'create'])->name('create');
        Route::post("/store", [UserController::class, 'store'])->name('store');
    });

    Route::middleware("ApplicantRule")->group(function(){
        Route::prefix("applicant")->name("applicant.")->group(function () {
            Route::get("/", [ApplicantController::class, 'index'])->name('index');
            Route::get("/create", [ApplicantController::class, 'create'])->name('create');
            Route::post("/store", [ApplicantController::class, 'store'])->name('store');
            Route::get("/show/{id}", [ApplicantController::class, 'show'])->name('show');
            Route::get("/download/{id}", [ApplicantController::class, 'download'])->name('download');
        });

    });

    Route::prefix("cv_review")->name("cv_review.")->group(function () {
        Route::get("/", [CvReviewController::class, 'index'])->name('index');
        Route::post("/store/{id}", [CvReviewController::class, 'store'])->name('store');
        Route::get("/show/{id}", [CvReviewController::class, 'show'])->name('show');
    });

    Route::prefix("interview")->name("interview.")->group(function () {
        Route::get("/", [InterviewController::class, 'index'])->name('index');
        Route::post("/store/{id}", [InterviewController::class, 'store'])->name('store');
        Route::get("/show/{id}", [InterviewController::class, 'show'])->name('show');
    });
});
// CSRF





require __DIR__ . '/auth.php';
