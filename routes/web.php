<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Gate;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// Route::get('/admin', function () {  //////only acessed by admin
//     return view('dashboard');
// })->middleware(['auth', 'role:admin'])->name('dashboard1');

// Route::get('/editor', function () { /////////only acessed by editor
//     return view('dashboard');
// })->middleware(['auth', 'role:editor'])->name('dashboard2');

// Route::get('/user', function () { ////////only acessed by user
//     return view('dashboard');
// })->middleware(['auth', 'role:user'])->name('dashboard3');



// Admin Route (Only for Admins)
Route::get('/admin', function () {
    if (Gate::denies('is-admin')) {
        abort(403);
    }
    return view('dashboard');
})->middleware('auth')->name('dashboard');



// Editor Route (Only for Editors)
Route::get('/editor', function () {
    if (Gate::denies('is-editor')) {
        abort(403);
    }
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// User Route (Only for Users)
Route::get('/user', function () {
    if (Gate::denies('is-user')) {
        abort(403);
    }
    return view('dashboard');
})->middleware('auth')->name('dashboard');



Route::get('/register', function () { return view('auth.register'); });
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () { return view('auth.login'); });
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth');

require __DIR__.'/auth.php';
