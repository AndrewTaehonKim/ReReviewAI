<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalcProblemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MathJaxController;
use Illuminate\Support\Facades\Route;

/* Navigation Routes */
// homepage
Route::get('/', function () {
    return view('home');
})->name('home');
    // show calc problem
Route::get('/calc-problem/{id}', [CalcProblemController::class, 'showProblem'])->name('show-calc-problem');
Route::get('/test', function () {
    $data = '<p>Solve for <img src="storage_path(\'app/images/calc/image_64844267c0727.png\'))"></p>';

    return view('calcProblem.email')->with('question', $data);
});
/* ------------------------------------------------ */

/* Controller Routes */
    // makes and stores calc problem in the database -> returns the problem object
    // makes, stores, and redirects to show the problem
Route::post('/make-store-show-calc-problem', [CalcProblemController::class, 'makeStoreShow'])->name('make-store-show-calc-problem');
    // gets a problem that a user has not yet seen
Route::post('/get-unique-calc-problem', [CalcProblemController::class, 'getUniqueProblem'])->name('get-unique-problem');
    // rewrite a stringEquation into html with embedded images
Route::post('/math-to-image', [MathJaxController::class, 'mathToImage'])->name('math-to-image');

/* ------------------------------------------------ */

/* Routes that Require Authentication */
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
