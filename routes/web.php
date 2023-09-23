<?php

use App\Http\Controllers\MembersController;
use App\Http\Controllers\OfficeSpacesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TrainingHallsController;
use App\Http\Controllers\WorkspacesController;
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

Route::get('/', [SiteController::class, 'index'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'user-check'])->name('dashboard');

Route::middleware(['auth', 'user-check'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('members')->name('members.')->group(function () {
        Route::get('/admins', [MembersController::class, 'admins'])->name('admins');
        Route::get('/users', [MembersController::class, 'users'])->name('users');
    });

    Route::resource('members', MembersController::class);
    Route::resource('trainingHalls', TrainingHallsController::class);
    Route::resource('workspaces', WorkspacesController::class);
    Route::get('officeSpaces/create', [OfficeSpacesController::class, 'create'])->name('officeSpaces.create');
    Route::post('officeSpaces', [OfficeSpacesController::class, 'store'])->name('officeSpaces.store');
});

Route::view('no-access', 'no-access');

Route::prefix('site')->middleware('auth')->name('site.')->group(function(){
    Route::get('/', [SiteController::class, 'index'])->name('index');
    Route::get('/about', [SiteController::class, 'about'])->name('about');
    Route::get('/trainingHalls', [SiteController::class, 'trainingHalls'])->middleware('admin-check')->name('trainingHalls');
    Route::get('/workspaces', [SiteController::class, 'workspaces'])->name('workspaces');
    Route::post('/trainingHalls/{trainingHall}', [SiteController::class, 'trainingHallBooking'])->middleware('admin-check')->name('trainingHalls.booking');
    Route::post('/workspaces/{workspace}', [SiteController::class, 'workspaceBooking'])->middleware('admin-check')->name('workspaces.booking');
    Route::get('/booking-requests/{user}', [SiteController::class, 'bookingRequest'])->name('booking-requests');
    Route::delete('/trainingHall/{trainingHall}/destroy', [SiteController::class, 'destroy'])->name('trainingHall.destroy');
});
require __DIR__ . '/auth.php';
