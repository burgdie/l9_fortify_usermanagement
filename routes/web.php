<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
//use Admin\UserController;

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

Route::get('/', function () {
    return view('index');
});

/**
 * Three main areas of this application
 * The first area is going to be the public facing website where a user can login and
 * register
 * The second part is going to be the user section where the user logins and the user
 * can see certain things
 * The thid part is going to be the admin section where an admin user logs in and can
 * access teh admin part.
 *
 */

 // Admin Part
Route::prefix('admin')->middleware('auth','auth.isAdmin' )->name('admin.')->group(function() {
    Route::resource('/users', UserController::class);
});
