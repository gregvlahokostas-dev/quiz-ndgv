<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::middleware(['auth'])->group(function () {

    // 🏠 HOME — μενού επιλογής
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Compatibility με Breeze
    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');

    // 📚 QUIZ
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
    Route::post('/quiz/start', [QuizController::class, 'start'])->name('quiz.start');
    Route::get('/quiz/play', [QuizController::class, 'play'])->name('quiz.play');
    Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/leaderboard', [QuizController::class, 'leaderboard'])->name('quiz.leaderboard');

    // 📖 STUDY (Μελέτη)
    Route::get('/study', [StudyController::class, 'index'])->name('study.index');
    Route::post('/study/show', [StudyController::class, 'show'])->name('study.show');

    // 👤 Profile (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
