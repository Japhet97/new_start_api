<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PrincipleController;

Route::get('/', function () {
    return redirect()->route('admin.principles.index');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/principles', [PrincipleController::class, 'index'])->name('principles.index');
    Route::get('/principles/create', [PrincipleController::class, 'create'])->name('principles.create');
    Route::post('/principles', [PrincipleController::class, 'store'])->name('principles.store');
    Route::get('/principles/{principle}', [PrincipleController::class, 'show'])->name('principles.show');
    Route::post('/principles/{principle}/lessons', [PrincipleController::class, 'addLesson'])->name('principles.addLesson');
    Route::post('/principles/{principle}/quizzes', [PrincipleController::class, 'addQuiz'])->name('principles.addQuiz');
});
