<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

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
Route::get('/programflow', [VisitorPageController::class, 'programme']);

/* ## END Visitor Module Region ## */


/* ## START CMS Module Region ## */

/*
-------------------
    Login Routes
------------------- 
*/ 

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login/signin', [LoginController::class, 'signin']);
Route::post('/login/list', [LoginController::class, 'list']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

/* ## END CMS Module Region ## */
