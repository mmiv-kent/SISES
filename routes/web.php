<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\RoomsController;
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
Route::get('/students/{student}/edit', [StudentsController::class, 'edit'])->name('students.edit');
Route::post('/students', [StudentsController::class, 'store'])->name('students.store');
Route::put('/students/{student}', [StudentsController::class, 'update'])->name('students.update');
Route::delete('/students/{student}', [StudentsController::class, 'destroy'])->name('students.destroy');

/* pdf */

Route::get('/students/export', [StudentsController::class, 'export'])->name('students.export');

//-- rooms route --//
Route::resource('rooms', RoomsController::class)->except(['show']);
Route::get('/rooms/export-pdf', [RoomsController::class, 'exportPdf'])->name('rooms.exportPdf');


//--rent route --//
Route::resource('rentals', RentController::class)->except(['show']);
Route::get('/rentals/pdf', [RentController::class, 'generatePdf'])->name('rentals.pdf');
