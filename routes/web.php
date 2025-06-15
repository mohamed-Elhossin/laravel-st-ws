<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('admin.pages.index');
})->middleware(['auth'])->name('dashboard');

// -------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix("user")->name("user.")->group(function () {
        Route::get("/", [UserController::class, 'index'])->name('index');
        Route::get("/create", [UserController::class, 'create'])->name('create');
        Route::post("/store", [UserController::class, 'store'])->name('store');
        Route::get("/edit/{user}", [UserController::class, 'edit'])->name('edit');
        Route::post("/update/{user}", [UserController::class, 'update'])->name('update');
        Route::get("/destroy/{user}", [UserController::class, 'destroy'])->name('destroy');
        Route::get("/show/{user}", [UserController::class, 'show'])->name('show');
    });


    Route::prefix("employee")->name("employee.")->group(function () {
        Route::get("/", [EmployeeController::class, 'index'])->name('index');
        Route::get("/create", [EmployeeController::class, 'create'])->name('create');
        Route::post("/store", [EmployeeController::class, 'store'])->name('store');
        Route::get("/edit/{employee}", [EmployeeController::class, 'edit'])->name('edit');
        Route::put("/update/{employee}", [EmployeeController::class, 'update'])->name('update');
        Route::get("/destroy/{employee}", [EmployeeController::class, 'destroy'])->name('destroy');
        Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    });
    
    Route::prefix("leave")->name("leave.")->group(function () {
        Route::get("/", [LeaveController::class, 'index'])->name('index');
        Route::get("/create", [LeaveController::class, 'create'])->name('create');
        Route::post("/store", [LeaveController::class, 'store'])->name('store');
        Route::get("/edit/{leave}", [LeaveController::class, 'edit'])->name('edit');
        Route::put("/update/{leave}", [LeaveController::class, 'update'])->name('update');
        Route::get("/destroy/{leave}", [LeaveController::class, 'destroy'])->name('destroy');
        Route::get('/employees/{employee}', [LeaveController::class, 'show'])->name('employees.show');
    });


    Route::prefix("department")->name("department.")->group(function () {
        Route::get("/", [DepartmentController::class, 'index'])->name('index');
        Route::get("/create", [DepartmentController::class, 'create'])->name('create');
        Route::post("/store", [DepartmentController::class, 'store'])->name('store');
        Route::get("/edit/{employee}", [DepartmentController::class, 'edit'])->name('edit');
        Route::post("/update/{employee}", [DepartmentController::class, 'update'])->name('update');
        Route::get("/destroy/{employee}", [DepartmentController::class, 'destroy'])->name('destroy');
        Route::get("/show/{employee}", [DepartmentController::class, 'show'])->name('show');
        Route::resource('departments', DepartmentController::class);
        Route::resource('employees', EmployeeController::class);
    });
});






require __DIR__ . '/auth.php';
Route::resource('departments', DepartmentController::class);
Route::resource('employees', EmployeeController::class);
