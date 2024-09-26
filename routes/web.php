<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified','normal'])
    ->name('dashboard');

    Route::view('admin', 'admin')
    ->middleware(['auth', 'verified','admin'])
    ->name('admin');

    Route::view('superadmin', 'superadmin')
    ->middleware(['auth', 'verified','superadmin'])
    ->name('superadmin');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::group(['middleware' => ['role:super-admin|admin']], function() {

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);
    
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);
    
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

    Route::resource('guests', App\Http\Controllers\GuestsController::class);
    Route::get('guests/{guestId}/delete', [App\Http\Controllers\GuestsController::class, 'destroy']);

    Route::resource('rooms', App\Http\Controllers\RoomsController::class);
    Route::get('rooms/{roomId}/delete', [App\Http\Controllers\RoomsController::class, 'destroy']);
    
    });

Route::post('/logout', function () {
        Auth::logout();
        return redirect('/'); // Redirect to homepage or login page
    })->name('logout');
    
require __DIR__.'/auth.php';
