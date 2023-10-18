<?php
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaptchaController;


Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comments', [CommentController::class, 'store']);



Route::get('/captcha', [CaptchaController::class, 'generateCaptcha']);
Route::post('/captcha-verify', [CaptchaController::class, 'verifyCaptcha']);


