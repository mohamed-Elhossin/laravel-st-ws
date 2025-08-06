<?php

use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaveUsageController;
use App\Http\Controllers\CompanyController;
 

use App\Http\Controllers\CountryController;

Route::get('/', function () {
    return view('auth.login');
})->middleware("guest");

Route::get('/dashboard', function () {
    $news = News::orderBy('created_at', 'desc')->get();
    return view('admin.pages.index', compact('news'));
})->middleware(['auth'])->name('dashboard');

// -------------
Route::middleware('auth')->group(function () {

    Route::middleware('adminRole')->group(function () {


        Route::resource('feedback', FeedbackController::class);
        Route::get("ontherFeedback", [FeedbackController::class, 'ontherFeedback'])->name('ontherFeedback');

        Route::resource('news', NewsController::class);
        Route::prefix("user")->name("user.")->group(function () {
            Route::get("/", [UserController::class, 'index'])->name('index');
            Route::get("/create", [UserController::class, 'create'])->name('create');
            Route::post("/store", [UserController::class, 'store'])->name('store');
            Route::get("/edit/{user}", [UserController::class, 'edit'])->name('edit');
            Route::post("/update/{user}", [UserController::class, 'update'])->name('update');
            Route::get("/destroy/{user}", [UserController::class, 'destroy'])->name('destroy');
            Route::get("/show/{user}", [UserController::class, 'show'])->name('show');
        });


        Route::prefix("leave-usages")->name("leave-usages.")->group(function () {
            Route::get('/', [LeaveUsageController::class, 'index'])->name("index");

            Route::get("/create/{id}", [LeaveUsageController::class, 'create'])->name("create");
            // عرض واحد
            Route::get('{id}', [LeaveUsageController::class, 'show'])->name("show");

            // إضافة جديد
            Route::post('/', [LeaveUsageController::class, 'store'])->name("store");

            // تعديل
            Route::post('{id}', [LeaveUsageController::class, 'update'])->name("update");

            // حذف
            Route::get('/delete/{id}', [LeaveUsageController::class, 'destroy'])->name("destroy");
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



Route::resource('countries', CountryController::class);

    Route::resource('departments', DepartmentController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('companies', CompanyController::class);

    Route::get("profile_info", [UserController::class, 'profile_info'])->name("profile_info");
    Route::get('/profile', [UserController::class, 'profile_info'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get("error403", function () {
    return view('error403');
})->name("error403");



require __DIR__ . '/auth.php';
