<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProgramFlowController;
use App\Http\Controllers\LoginController;
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
    Home Routes
------------------- 
*/ 
Route::get('/', function(){ return Redirect::to("/home"); });
Route::get('/home', [LandingPageController::class, 'index']);

/*
-------------------
    ProgramFlow Routes
------------------- 
*/ 
Route::get('/programflow', [ProgramFlowController::class, 'index']);

/* ## END Visitor Module Region ## */



/* ## START CMS Module Region ## */

/*
-------------------
    Login Routes
------------------- 
*/ 
Route::get('/login', [LoginController::class, 'index']);


/* ## END CMS Module Region ## */