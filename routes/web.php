<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\FungsiController;
use App\Http\Controllers\AnswerController;

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
    return view('login');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/topic/{id}', [TopicController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('topic');

Route::middleware('auth')->group(function () {

    Route::get('/data/{id}', [DashboardController::class, 'getData'])->name('topic.gettaskdata');
    // Route::get('/json-data/{id}', [TaskController::class, 'getData'])->name('task.data');
    // Route::post('/update-data/{id}', [TaskController::class, 'updateData'])->name('task.updatedata');
    // Route::post('/add-json-data/{id}', [TaskController::class, 'addJsonData'])->name('add.jsondata');
    // Route::post('/del-json-data/{id}', [TaskController::class, 'delJsonData'])->name('del.jsondata');
    // Route::get('/show/{topicid}/{taskno}', [TaskController::class, 'show'])->name('show.page');

    Route::get('/json-data/{id}', [AnswerController::class, 'getData'])->name('answer.data');
    Route::post('/update-data/{id}', [AnswerController::class, 'updateData'])->name('answer.updatedata');
    Route::post('/add-json-data/{id}', [AnswerController::class, 'addJsonData'])->name('answer.add.jsondata');
    Route::post('/del-json-data/{id}', [AnswerController::class, 'delJsonData'])->name('answer.del.jsondata');
    Route::get('/show/{userid}/{taskid}', [TaskController::class, 'show'])->name('show.page');
    Route::get('/code', [TaskController::class, 'getDownload'])->name('code.download');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upload-pdf', [TopicController::class, 'uploadPDF'])->name('uploadPDF');
    Route::get('/download-pdf/{id}', [TopicController::class, 'downloadPDF'])->name('downloadPDF');

    Route::get('/fungsi/{id}', [FungsiController::class, 'index'])->name('fungsi.index');
    Route::get('/fungsi/destroy/{id}', [FungsiController::class, 'destroy'])->name('fungsi.delete');
    Route::get('/fungsi/create/{id}', [FungsiController::class, 'create'])->name('fungsi.create');
    Route::get('/fungsi/json-data/{id}', [FungsiController::class, 'getData'])->name('fungsi.data');
    Route::post('/fungsi/update-data/{id}', [FungsiController::class, 'updateData'])->name('fungsi.updatedata');
    Route::post('/fungsi/add-json-data/{id}', [FungsiController::class, 'addJsonData'])->name('fungsi.add.jsondata');
    Route::post('/fungsi/del-json-data/{id}', [FungsiController::class, 'delJsonData'])->name('fungsi.del.jsondata');
    Route::get('/get-fungsi/{id}', [FungsiController::class, 'getAllFungsi'])->name('getAllFungsi');
    // Route::get('/get-fungsi/{id}', [FungsiController::class, 'getAllFungsi'])->name('getTask');
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
