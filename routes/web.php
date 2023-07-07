<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TopicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/topic/{id}', [TopicController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('topic');

Route::middleware('auth')->group(function () {

    Route::get('/data/{id}', [DashboardController::class, 'getData'])->name('topic.gettaskdata');
    Route::get('/json-data/{id}', [TaskController::class, 'getData'])->name('task.data');
    Route::post('/update-data', [TaskController::class, 'updateData']);
    Route::post('/add-json-data', [TaskController::class, 'addJsonData'])->name('add.jsondata');
    Route::post('/del-json-data', [TaskController::class, 'delJsonData'])->name('del.jsondata');
    Route::get('/show/{id}', [TaskController::class, 'show'])->name('show.page');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upload-pdf', [TopicController::class, 'uploadPDF'])->name('uploadPDF');
    Route::get('/download-pdf/{id}', [TopicController::class, 'downloadPDF'])->name('downloadPDF');
});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
