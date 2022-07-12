<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorPageController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\GraduatesController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\GuestController;

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\HonorController;

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
Route::get('/gallery', [VisitorPageController::class, 'gallery']);
Route::get('/graduates-gallery', [VisitorPageController::class, 'graduates_gallery']);

/* ## END Visitor Module Region ## */


/* ## START CMS Module Region ## */

/*
-------------------
    Login Routes
------------------- 
*/ 

Route::get('/login', [LoginController::class, 'index'])->middleware('islogged');
Route::post('/login/signin', [LoginController::class, 'signin']);
Route::get('/login/signout', [LoginController::class, 'signout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/graduates', [GraduatesController::class, 'index'])->middleware('auth');

Route::get('/faculty', [FacultyController::class, 'index'])->middleware('auth');

Route::get('/guest', [GuestController::class, 'index'])->middleware('auth');

Route::get('/academicYear', [AcademicYearController::class, 'index'])->middleware('auth');
Route::get('/academicYear/datatable', [AcademicYearController::class, 'datatable'])->middleware('auth');
Route::post('/academicYear/add', [AcademicYearController::class, 'add'])->middleware('auth');
Route::any('/academicYear/edit', [AcademicYearController::class, 'edit'])->middleware('auth');

Route::get('/semester', [SemesterController::class, 'index'])->middleware('auth');
Route::get('/semester/datatable', [SemesterController::class, 'datatable'])->middleware('auth');
Route::post('/semester/add', [SemesterController::class, 'add'])->middleware('auth');
Route::any('/semester/edit', [SemesterController::class, 'edit'])->middleware('auth');

Route::get('/college', [CollegeController::class, 'index'])->middleware('auth');
Route::get('/college/datatable', [CollegeController::class, 'datatable'])->middleware('auth');
Route::post('/college/add', [CollegeController::class, 'add'])->middleware('auth');
Route::any('/college/edit', [CollegeController::class, 'edit'])->middleware('auth');

Route::get('/program', [ProgramController::class, 'index'])->middleware('auth');

Route::get('/organization', [OrganizationController::class, 'index'])->middleware('auth');

Route::get('/position', [PositionController::class, 'index'])->middleware('auth');

Route::get('/honor', [HonorController::class, 'index'])->middleware('auth');
Route::get('/honor/datatable', [HonorController::class, 'datatable'])->middleware('auth');
Route::post('/honor/add', [HonorController::class, 'add'])->middleware('auth');
Route::any('/honor/edit', [HonorController::class, 'edit'])->middleware('auth');

/* ## END CMS Module Region ## */
