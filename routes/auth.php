<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/register/customer', [RegisteredUserController::class, 'create_new_customer'])
                ->middleware('guest')
                ->name('register.customer');

Route::post('/register/customer', [RegisteredUserController::class, 'store_new_customer'])
                ->middleware('guest')->name('store.customer');

Route::get('/register/car-rental-agent', [RegisteredUserController::class, 'create_new_car_rental_agent'])
    ->middleware('guest')
    ->name('register.car-rental-agent');

Route::post('/register/car-rental-agent', [RegisteredUserController::class, 'store_new_carRentalAgent'])
    ->middleware('guest');

Route::get('/login/customer', [AuthenticatedSessionController::class, 'create_customer'])
                ->middleware('guest')
                ->name('login.customer');

Route::post('/login/customer', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest')->name('login.customer.store');

Route::get('/login/agent', [AuthenticatedSessionController::class, 'create_agent'])
    ->middleware('guest')
    ->name('login.agent');

Route::post('/login/agent', [AuthenticatedSessionController::class, 'store_agent'])
    ->middleware('guest')->name('login.agent.store');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
