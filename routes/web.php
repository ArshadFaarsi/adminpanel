<?php

use App\Http\Controllers\Admin\AboutusController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\OfficerController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\TermConditionController;
use Illuminate\Support\Facades\Route;

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
/*
Admin routes
 * */
Route::get('/admin', [AuthController::class, 'getLoginPage']);
Route::post('admin/login', [AuthController::class, 'Login']);
Route::get('/admin-forgot-password', [AdminController::class, 'forgetPassword']);
Route::post('/admin-reset-password-link', [AdminController::class, 'adminResetPasswordLink']);
Route::get('/change_password/{id}', [AdminController::class, 'change_password']);
Route::post('/admin-reset-password', [AdminController::class, 'ResetPassword']);

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'getdashboard']);
    Route::get('profile', [AdminController::class, 'getProfile']);
    Route::post('update-profile', [AdminController::class, 'update_profile']);
    Route::get('logout', [AdminController::class, 'logout']);
    /**officer */
    Route::get('officer/status/{id}', [OfficerController::class, 'status'])->name('officer.status');
    /**company */
    Route::get('company/status/{id}', [CompanyController::class, 'status'])->name('company.status');

    /** resource controller */
    Route::resource('officer', OfficerController::class);
    Route::resource('company', CompanyController::class);
    Route::resource('about', AboutusController::class);
    Route::resource('policy', PolicyController::class);
    Route::resource('terms', TermConditionController::class);
    Route::resource('faq', FaqController::class);

});
