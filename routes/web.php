<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;

/*
|--------------------------------------------------------------------------
| Route Templates
|--------------------------------------------------------------------------
|
| Este archivo contiene plantillas de rutas reutilizables que pueden ser
| utilizadas en diferentes partes de la aplicación. Las rutas aquí definidas
| siguen patrones comunes y pueden ser extendidas o modificadas según sea necesario.
|
*/

// locale
Route::get('/lang/{locale}', [LanguageController::class, 'swap']);
// Jetstream Authentication Routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/auth/login', [LoginController::class, 'login'])->name('auth.login');
Route::post('/auth/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('/password/confirm', [ConfirmPasswordController::class, 'confirm']);


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])
->group(function () 
{
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  
  // Módulo de Usuarios
  Route::resource('users', UserController::class);
  Route::get('users-search', [UserController::class, 'search'])->name('users.search');
  Route::get('users-export', [UserController::class, 'export'])->name('users.export');
  Route::patch('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
  Route::patch('users/{user}/reactivate', [UserController::class, 'reactivate'])->name('users.reactivate');

  // Módulo de Roles
  Route::resource('roles', RoleController::class);
  Route::get('roles/{role}/data', [RoleController::class, 'getRoleData'])->name('roles.data');

  // Módulo de Personas
  Route::get('people', [PeopleController::class, 'index'])->name('people.index');
  Route::get('people/create', [PeopleController::class, 'create'])->name('people.create');
  Route::post('people', [PeopleController::class, 'store'])->name('people.store');
  Route::get('people/{id}/show', [PeopleController::class, 'show'])->name('people.show');
  Route::post('people/update-status', [PeopleController::class, 'updateStatus'])->name('people.update-status');
  Route::post('people/export-excel', [PeopleController::class, 'exportExcel'])->name('people.export-excel');
  Route::post('people/export-pdf', [PeopleController::class, 'exportPdf'])->name('people.export-pdf');
  
  // Rutas API para selects dinámicos
  Route::get('api/municipalities/{province_id}', [PeopleController::class, 'getMunicipalities'])->name('api.municipalities');
  Route::get('api/sectors/{municipality_id}', [PeopleController::class, 'getSectors'])->name('api.sectors');
});

// Jetstream Routes
require __DIR__.'/jetstream.php';
