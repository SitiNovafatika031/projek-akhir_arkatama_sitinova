<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ConfirmPasswordController;


Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('register', [RegisterController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisterController::class, 'store']);

    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
                ->name('password.request');

    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
                ->name('password.email');

    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
                ->name('password.reset');

    Route::post('reset-password', [ResetPasswordController::class, 'reset'])
                ->name('password.update');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('verify-email', [VerificationController::class, 'show'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerificationController::class, 'verify'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [VerificationController::class, 'resend'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmPasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmPasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});