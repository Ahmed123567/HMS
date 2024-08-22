<?php

use App\Http\Controllers\back\AdminProfileController;
use App\Http\Controllers\back\AppointmentController;
use App\Http\Controllers\back\AttendanceEmployeeController;
use App\Http\Controllers\back\AutoDoctorController;
use App\Http\Controllers\back\DashboardController;
use App\Http\Controllers\back\DepartmentController;
use App\Http\Controllers\back\DoctorController;
use App\Http\Controllers\back\EmployeeController;
use App\Http\Controllers\back\PatientController;
use App\Http\Controllers\back\PermissionController;
use App\Http\Controllers\back\ProfileController;
use App\Http\Controllers\back\ResrvationController;
use App\Http\Controllers\back\RoleController;
use App\Http\Controllers\back\RomeController;
use App\Http\Controllers\back\ShiftController;
use App\Http\Controllers\back\UserController;
use App\Http\Controllers\back\LabController;
use App\Http\Controllers\back\SettingController;
use App\Http\Controllers\front\PatientViewController;
use App\Http\Controllers\PatientRecordController;
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

    if(auth()->check() && auth()->user()->isPatient()) {
        return redirect()->route("patient.view.index");
    }
    return redirect()->route("login");
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::resource("user", UserController::class)->except("show");
    Route::resource("role", RoleController::class)->except("show");
    Route::resource("employee", EmployeeController::class)->except("show");
    Route::resource("department", DepartmentController::class)->except("show");
    Route::resource("shift", ShiftController::class)->except("show");
    Route::resource("room", RomeController::class)->except("show");
    Route::resource("patient", PatientController::class)->except("show");
    Route::resource("attendance", AttendanceEmployeeController::class)->only("index", "create", "store");


    Route::prefix("appointmentResrvation")->as("appointment.reserve.")->controller(AppointmentController::class)->group(function() {
        Route::get("/", "index")->name("index");
        Route::get("resrvaaitons/{doctor}", "resrvations")->name("resrvations");
        Route::get("reportModal/{appointmentResrvation}", "report")->name("report");
        Route::post("reserve", "store")->name("store");
        Route::post("confirm/{appointmentResrvation}", "confirm")->name("confirm");
        Route::post("close/{appointmentResrvation}", "close")->name("close");
    });


    Route::prefix("permission")->as("permission.")->controller(PermissionController::class)->group(function () {
        Route::get("/", "index")->name("index");
        Route::post("/", "store")->name("store");
        Route::delete("/{permission}", "destroy")->name("destroy");
    });

    Route::prefix("resrvation")->as("room.reserve.")->controller(ResrvationController::class)->group(function() {
        Route::get("/", "index")->name("index");
        Route::post("reserve", "store")->name("store");
        Route::post("confirm/{roomResrvation}", "confirm")->name("confirm");
    });

    Route::prefix("room")->as("room.")->controller(RomeController::class)->group(function() {
        Route::get("ajax/{room}", "roomAjax")->name("ajax");
        Route::get("resrvations/{room}", "showResrvations")->name("showResrvations");
    });

    Route::prefix("admin/profile/")->as("admin.profile.")->controller(AdminProfileController::class)->group(function () {
        Route::get("/", "index")->name("index");
        Route::put("/", "update")->name("update");
    });

    Route::prefix("employee")->as("employee.")->controller(EmployeeController::class)->group(function () {
        Route::get("employeeOrPatients/{role}", "getPeople")->name("employeeOrPatient");
    });

    Route::prefix("appointment")->as("appointment.")->controller(RomeController::class)->group(function() {
        Route::get("resrvations/{room}", "resrvation")->name("resrvation");
    });

    Route::prefix("settings")->as("setting.")->controller(SettingController::class)->group(function() {
        Route::get("/", "index")->name("index");
        Route::post("/reservation", "reservation")->name("reservation");
    });


    Route::get("DepartmentDoctors/{department}", [DepartmentController::class, "deprtmentDoctors"])->name("deparmtent.doctors");
    Route::get("/profile", [ProfileController::class, "index"])->name("admin.profile.index");

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    // lab front end


    Route::get("/analysis", [LabController::class, "analysis"]);
    Route::post("/StoreLab" , [LabController::class ,"store"]);
    Route::post("/Storelab2" , [LabController::class ,"store2"]);


     // store the attachment
    Route::post("/StoreAttachment/{id}" , [LabController::class ,"storeAttachment"]);


    // fetch Patient Name Through its ID
    Route::get("/fetch-patient-name/{id}", [LabController::class, "fetchName"]);

             // Mark All Messages as read
    Route::get('MarkAsRead_all',[LabController::class,'MarkAsRead_all'])->name('MarkAsRead_all');





    // doctor view
    Route::prefix("autoDoctor")->as("autoDoctor.")->controller(AutoDoctorController::class)->group(function () {
        Route::get("/", "index")->name("index");
        Route::get("/covid", "covid")->name("covid");
        Route::post("/covid", "covidCheck")->name("covidCheck");

        Route::get("/brainTumor", "brainTumor")->name("brainTumor");
        Route::post("/brainTumor", "brainTumorCheck")->name("brainTumorCheck");

        Route::get("/ecg", "ecg")->name("ecg");
        Route::post("/ecg", "ecgCheck")->name("ecgCheck");
    });


    Route::get("doctor/patients/{doctor}", [DoctorController::class, "patients"])->name("doctor.patients");
    Route::get("patient/medicalProfile/{patient}", [PatientController::class, "medicalProfile"])->name("patient.medicalProfile");
    Route::get("patient/medicalHistory/{patient}", [PatientController::class, "medicalHistory"])->name("patient.medicalHistory");
    Route::put("patient/updateHistory/{patient}", [PatientController::class, "updateHistory"])->name("patient.updateHistory");
    Route::get("patient/files/{record}", [PatientController::class, "files"])->name("patient.files");
    Route::get("doctorAjax/{doctor}", [AppointmentController::class, "doctorAjax"])->name("doctor.ajax");
   

    // patient front end

    Route::prefix("patient/view")->as("patient.view.")->controller(PatientViewController::class)->group(function () {
        Route::view("/", "front.patient.index")->name("index");
        Route::view("/account", "front.patient.account")->name("account");
        Route::view("/medical_history", "front.patient.medical_history")->name("medical_history");
        Route::view("/medical_profile", "front.patient.medical_profile")->name("medical_profile");
        Route::get("/appointment", "appointment")->name("appointment");
        
        
        Route::post("/reserve", "reserve")->name("reserve");
        Route::put("/accountUpdate", "accountUpdate")->name("accountUpdate");
        Route::delete("/reservation/{reservation}", "deleteReservation")->name("reservation");
    });
    
    Route::get("doctorPatientViewAjax/{doctor}", [AppointmentController::class, "doctorPatientViewAjax"])->name("doctor.patientView.ajax");
    
    Route::get("/patientrecordsAjax/{patient}",[PatientRecordController::class, "recordsAjax"])->name("patient.recordsAjax");
    Route::get("/doctorResrvationAjax/{doctor}",[DoctorController::class, "resrvationAjax"])->name("doctor.resrvationAjax");


});

require __DIR__.'/auth.php';
