<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

Route::middleware('auth:api')->group(function () {
    // User CRUD
    Route::resource('users', UserController::class);

    // Role CRUD
    Route::resource('roles', RoleController::class);

    // Permission CRUD
    Route::resource('permissions', PermissionController::class);

    // Assign roles to users and permissions to roles
    Route::post('users/{user}/assign-role', [UserController::class, 'assignRole']);
    Route::post('roles/{role}/assign-permission', [RoleController::class, 'assignPermission']);
});

Route::get('/admin', function () {
    return 'Admin Dashboard';
})->middleware('role:admin');
