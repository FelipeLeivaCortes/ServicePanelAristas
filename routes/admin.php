<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\WooCommerceController;
use App\Http\Controllers\Admin\SapController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get("dashboard", [DashboardController::class, "index"])->name('dashboard.index');

Route::resource('companies', CompanyController::class)->names('companies');

Route::resource('roles', RoleController::class)->names('roles');

Route::resource('permissions', PermissionController::class)->names('permissions');

Route::resource('users', UserController::class)->names('users');

Route::get('notifications/all/{user}', [NotificationController::class, 'all'])->name('notifications.all');

Route::post('notifications/mark_as_read', [NotificationController::class, 'mark_as_read'])->name('notifications.mark_as_read');

Route::post('profile/updatePassword/{user}', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

Route::resource('profile', ProfileController::class)->names('profiles');

Route::resource('reports/events', EventController::class)->names('reports.events');



Route::get('sync/index', function () {
    return view('admin.sync.index');
});


Route::post('woocommerce/sync/{entity}', [WooCommerceController::class, 'syncStep'])->name('woocommerce.syncStep');

Route::post('sap/sync/{entity}', [SapController::class, 'syncStep'])->name('woocommerce.syncStep');
