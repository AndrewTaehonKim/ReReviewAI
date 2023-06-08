<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalcProblemController;
use Illuminate\Support\Facades\Route;

/* Navigation Routes */
// homepage
Route::get('/', function () {
    return view('welcome');
})->name('home');
    // show calc problem
Route::get('/calc-problem/{id}', [CalcProblemController::class, 'showProblem'])->name('show-calc-problem');
/* ------------------------------------------------ */

/* Controller Routes */
    // makes calc problem -> returns the problem object
Route::post('/make-calc-problem', [CalcProblemController::class, 'makeProblem'])->name('make-calc-problem');
    // store calc problem -> takes in a CalcProblem::class -> returns the problem id
Route::post('/store-calc-problem', [CalcProblemController::class, 'store'])->name('store-calc-problem');
    // show calc problem with id
Route::get('/calc-problem/{id}', [CalcProblemController::class, 'showProblem'])->name('show-calc-problem');
    // makes and stores calc problem in the database -> returns the problem object
Route::post('/make-store-calc-problem', [CalcProblemController::class, 'makeStore'])->name('make-store-calc-problem');
    // makes, stores, and redirects to show the problem
Route::post('/make-store-show-calc-problem', [CalcProblemController::class, 'makeStoreShow'])->name('make-store-show-calc-problem');
    // gets a problem that a user has not yet seen
Route::post('/get-unique-calc-problem', [CalcProblemController::class, 'getUniqueProblem'])->name('get-unique-problem');
/* ------------------------------------------------ */

/* Routes that Require Authentication */
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
