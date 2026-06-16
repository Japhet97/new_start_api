<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PrincipleController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\QuizController;

Route::get('/', function () {
    return redirect()->route('admin.principles.index');
});

Route::prefix('admin')->name('admin.')->group(function () {
    // Principles
    Route::get('/principles', [PrincipleController::class, 'index'])->name('principles.index');
    Route::get('/principles/create', [PrincipleController::class, 'create'])->name('principles.create');
    Route::post('/principles', [PrincipleController::class, 'store'])->name('principles.store');
    Route::get('/principles/{principle}', [PrincipleController::class, 'show'])->name('principles.show');
    
    // Lessons
    Route::get('/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
    
    // Quizzes
    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
});
