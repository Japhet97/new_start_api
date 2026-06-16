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
    Route::resource('principles', PrincipleController::class);
    
    // Additional Principle Actions
    Route::post('/principles/{principle}/lessons', [PrincipleController::class, 'addLesson'])->name('principles.addLesson');
    Route::post('/principles/{principle}/quizzes', [PrincipleController::class, 'addQuiz'])->name('principles.addQuiz');
    
    // Lessons
    Route::get('/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
    
    // Quizzes
    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
});
