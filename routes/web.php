<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PrincipleController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\NotificationController;

Route::get('/', function () {
    return redirect()->route('admin.principles.index');
});

Route::prefix('admin')->name('admin.')->group(function () {
    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/send', [NotificationController::class, 'send'])->name('notifications.send');

    // Principles
    Route::resource('principles', PrincipleController::class);

    // Additional Principle Actions
    Route::post('/principles/{principle}/lessons', [PrincipleController::class, 'addLesson'])->name('principles.addLesson');
    Route::post('/principles/{principle}/quizzes', [PrincipleController::class, 'addQuiz'])->name('principles.addQuiz');

    // Lessons
    Route::resource('lessons', LessonController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);

    // Quizzes
    Route::resource('quizzes', QuizController::class)->only(['create', 'store', 'destroy']);
});
