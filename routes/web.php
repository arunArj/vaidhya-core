<?php

use App\Http\Controllers\PatientsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TallyController;
use App\Models\Patients;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/token', function () {
    return csrf_token();
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/get-groups', [TallyController::class, 'index']);
Route::get('/grpget', [TallyController::class, 'create']);

Route::get('/patients', [PatientsController::class, 'index']);
Route::get('/patients/{patient}', [PatientsController::class, 'show']);
Route::post('/patients', [PatientsController::class, 'store']);
Route::patch('/patients/{patients}', [PatientsController::class, 'update']);
Route::delete('/patients/{patients}', [PatientsController::class, 'destroy']);
require __DIR__.'/auth.php';
