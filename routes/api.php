<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIs\ApplicantController;
use App\Http\Controllers\APIs\AuthController;

Route::post("register", [AuthController::class, 'register']);
Route::post("login", [AuthController::class, 'login']);

Route::middleware("auth:sanctum")->group(function () {
    Route::prefix("applicant")->name("applicant.")->group(function () {
        Route::get("/", [ApplicantController::class, 'index'])->name('index');
        Route::post("/", [ApplicantController::class, 'store'])->name('store');
        Route::get("/{id}", [ApplicantController::class, 'show'])->name('show');
        Route::get("/download/{id}", [ApplicantController::class, 'download'])->name('download');
    });
    Route::post("logout", [AuthController::class, 'logout']);
});
