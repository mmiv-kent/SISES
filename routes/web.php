<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



//-- student route --//

Route::get('/students', [StudentsController::class, 'index'])->name('students.index');
Route::get('students/create', [StudentsController::class, 'create'])->name('students.create');
Route::resource('students', StudentsController::class);
Route::get('/students/{student}/edit', [StudentsController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [StudentsController::class, 'update'])->name('students.update');
Route::delete('/students/{student}', [StudentsController::class, 'destroy'])->name('students.destroy');
