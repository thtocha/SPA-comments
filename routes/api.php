<?php
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaptchaController;


Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/captcha', [CaptchaController::class, 'generateCaptcha'])->name('captcha.generate');
