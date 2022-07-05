<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorPageController;
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
    Visitor Module Routes
------------------- 
*/ 
Route::get('/', function(){ return Redirect::to("/home"); });
Route::get('/home', [VisitorPageController::class, 'home']);
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


/* ## END CMS Module Region ## */
