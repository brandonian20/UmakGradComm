<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorPageController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\GraduatesController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\OnSitePicsController;

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\HonorController;

use App\Http\Controllers\PicturesController;
use App\Http\Controllers\Select2Controller;
use App\Models\Semester;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* ## START Visitor Module Region ## */

/*
-------------------
    Visitor Module Routes
------------------- 
*/ 

Route::get('/', [VisitorPageController::class, 'home']);
// Route::get('/programflow', [VisitorPageController::class, 'programme']);
Route::get('/home/colleges', [VisitorPageController::class, 'colleges']);
// Route::get('/gallery', [VisitorPageController::class, 'gallery']);
Route::get('/gallery/{year}', [VisitorPageController::class, 'gallery_dev']);
// Route::get('/graduates-gallery', [VisitorPageController::class, 'graduates_gallery']);
Route::get('/graduates-gallery/{year}/{college}', [VisitorPageController::class, 'graduates_gallery_dev']);
// Route::get('/message', [VisitorPageController::class, 'message']);
Route::get('/message/{year}/{name}', [VisitorPageController::class, 'message_dev']);

/* ## END Visitor Module Region ## */


/* ## START CMS Module Region ## */

//Login
Route::get('/login', [LoginController::class, 'index'])->middleware('islogged');
Route::post('/login/signin', [LoginController::class, 'signin']);
Route::get('/login/signout', [LoginController::class, 'signout']);

//Images
Route::get('/pictures/image', [PicturesController::class, 'image']);
Route::get('/pictures/toga', [PicturesController::class, 'toga']);

//Select2Routes
Route::get('/select2/academicYear', [Select2Controller::class, 'academicYear'])->middleware('auth');
Route::get('/select2/semester', [Select2Controller::class, 'semester'])->middleware('auth');
Route::get('/select2/college', [Select2Controller::class, 'college'])->middleware('auth');
Route::get('/select2/program', [Select2Controller::class, 'program'])->middleware('auth');

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

//Graduates
Route::get('/graduates', [GraduatesController::class, 'index'])->middleware('auth');
Route::get('/graduates/datatable', [GraduatesController::class, 'datatable'])->middleware('auth');
Route::post('/graduates/add', [GraduatesController::class, 'add'])->middleware('auth');
Route::any('/graduates/edit', [GraduatesController::class, 'edit'])->middleware('auth');

//Messages
Route::get('/messages', [MessagesController::class, 'index'])->middleware('auth');
Route::get('/messages/datatable', [MessagesController::class, 'datatable'])->middleware('auth');
Route::post('/messages/add', [MessagesController::class, 'add'])->middleware('auth');
Route::any('/messages/edit', [MessagesController::class, 'edit'])->middleware('auth');

//OnSitePics
Route::get('/onsitepics', [OnSitePicsController::class, 'index'])->middleware('auth');
Route::get('/onsitepics/datatable', [OnSitePicsController::class, 'datatable'])->middleware('auth');
Route::post('/onsitepics/add', [OnSitePicsController::class, 'add'])->middleware('auth');
Route::any('/onsitepics/edit', [OnSitePicsController::class, 'edit'])->middleware('auth');

// Academic Year
Route::get('/academicYear', [AcademicYearController::class, 'index'])->middleware('auth');
Route::get('/academicYear/datatable', [AcademicYearController::class, 'datatable'])->middleware('auth');
Route::post('/academicYear/add', [AcademicYearController::class, 'add'])->middleware('auth');
Route::any('/academicYear/edit', [AcademicYearController::class, 'edit'])->middleware('auth');

// Semester
Route::get('/semester', [SemesterController::class, 'index'])->middleware('auth');
Route::get('/semester/datatable', [SemesterController::class, 'datatable'])->middleware('auth');
Route::post('/semester/add', [SemesterController::class, 'add'])->middleware('auth');
Route::any('/semester/edit', [SemesterController::class, 'edit'])->middleware('auth');

// College
Route::get('/college', [CollegeController::class, 'index'])->middleware('auth');
Route::get('/college/datatable', [CollegeController::class, 'datatable'])->middleware('auth');
Route::post('/college/add', [CollegeController::class, 'add'])->middleware('auth');
Route::any('/college/edit', [CollegeController::class, 'edit'])->middleware('auth');

// Program
Route::get('/program', [ProgramController::class, 'index'])->middleware('auth');
Route::get('/program/datatable', [ProgramController::class, 'datatable'])->middleware('auth');
Route::post('/program/add', [ProgramController::class, 'add'])->middleware('auth');
Route::any('/program/edit', [ProgramController::class, 'edit'])->middleware('auth');

// Organization
Route::get('/organization', [OrganizationController::class, 'index'])->middleware('auth');
Route::get('/organization/datatable', [OrganizationController::class, 'datatable'])->middleware('auth');
Route::post('/organization/add', [OrganizationController::class, 'add'])->middleware('auth');
Route::any('/organization/edit', [OrganizationController::class, 'edit'])->middleware('auth');

// Position
Route::get('/position', [PositionController::class, 'index'])->middleware('auth');
Route::get('/position/datatable', [PositionController::class, 'datatable'])->middleware('auth');
Route::post('/position/add', [PositionController::class, 'add'])->middleware('auth');
Route::any('/position/edit', [PositionController::class, 'edit'])->middleware('auth');

// Honor
Route::get('/honor', [HonorController::class, 'index'])->middleware('auth');
Route::get('/honor/datatable', [HonorController::class, 'datatable'])->middleware('auth');
Route::post('/honor/add', [HonorController::class, 'add'])->middleware('auth');
Route::any('/honor/edit', [HonorController::class, 'edit'])->middleware('auth');

/* ## END CMS Module Region ## */
