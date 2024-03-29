<?php

use App\Http\Controllers\{EventController, UserController};
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
    return view('home');
});

Route::group(['prefix' => 'users', 'as' => 'users_'], function () {
    Route::get('/', [UserController::class, 'list'])->name('list');

    Route::get('/create', [function () {
        return view('users.create');
    }])->name('create');

    Route::post('/create', [UserController::class, 'addUser']);

    Route::get('/delete/{id}', [UserController::class, 'deleteUser'])->name('delete');

    Route::get('/edit/{id}', [UserController::class, 'editUserForm'])->name('edit');

    Route::post('/edit/{id}', [UserController::class, 'editUser']);

    Route::get('/{id}', [UserController::class, 'details'])->name('details');

});


Route::group(['prefix' => 'events', 'as' => 'events_'], function () {

    Route::get('/', [EventController::class, 'list'])->name('list');

    Route::get('/create', [EventController::class, 'addEventForm'])->name('create');

    Route::post('/create', [EventController::class, 'addEvent']);

    Route::get('/delete/{id}', [EventController::class, 'deleteEvent'])->name('delete');

    Route::get('/edit/{id}', [EventController::class, 'editEventForm'])->name('edit');

    Route::post('/edit/{id}', [EventController::class, 'editEvent']);

    Route::get('/{id}', [EventController::class, 'details'])->name('details');

});

