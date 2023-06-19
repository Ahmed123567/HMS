<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AttendanceEmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResrvationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RomeController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route("login");
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource("user", UserController::class)->except("show");

    Route::resource("role", RoleController::class)->except("show");

    
    Route::resource("employee", EmployeeController::class)->except("show");

    Route::controller(EmployeeController::class)->prefix("employee")->as("employee.")->group(function () {
        Route::get("employeeOrPatients/{role}", "getPeople")->name("employeeOrPatient");
    });

    Route::resource("department", DepartmentController::class)->except("show");
    Route::resource("shift", ShiftController::class)->except("show");
    Route::resource("room", RomeController::class)->except("show");
   
    Route::prefix("room")->as("room.")->controller(RomeController::class)->group(function() {
        Route::get("json/{room}", "roomJson")->name("json");
        Route::get("resrvations/{room}", "showResrvations")->name("showResrvations");
    });

    
    Route::prefix("appointment")->as("appointment.")->controller(RomeController::class)->group(function() {
        // Route::get("json/{room}", "roomJson")->name("json");
        Route::get("resrvations/{room}", "resrvation")->name("resrvation");
    });


    Route::prefix("resrvation")->as("room.reserve.")->controller(ResrvationController::class)->group(function() {
        Route::get("/", "index")->name("index");
        Route::post("reserve", "store")->name("store");
        Route::post("confirm/{roomResrvation}", "confirm")->name("confirm");
    });

    Route::prefix("appointmentResrvation")->as("appointment.reserve.")->controller(AppointmentController::class)->group(function() {
        Route::get("/", "index")->name("index");
        Route::get("resrvaaitons/{doctor}", "resrvations")->name("resrvations");
        Route::get("reportModal/{appointmentResrvation}", "report")->name("report");
        Route::post("reserve", "store")->name("store");
        Route::post("confirm/{appointmentResrvation}", "confirm")->name("confirm");
        Route::post("close/{appointmentResrvation}", "close")->name("close");
    });

    Route::get("doctorJson/{doctor}", [AppointmentController::class, "doctorJson"])->name("doctor.json");

    Route::resource("patient", PatientController::class)->except("show");

    Route::resource("attendance", AttendanceEmployeeController::class)->only("index", "create", "store");




    Route::controller(PermissionController::class)->prefix("permission")->as("permission.")->group(function () {
        Route::get("/", "index")->name("index");
        Route::post("/", "store")->name("store");
        Route::delete("/{permission}", "destroy")->name("destroy");
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

require __DIR__.'/auth.php';
