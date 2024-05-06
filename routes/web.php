<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [TaskController::class, 'index'])->name('taskController.index');
    Route::get('create-task', [TaskController::class, 'createTask'])->name('taskController.create');
    Route::post('create-task', [TaskController::class, 'store'])->name('taskController.store');
    Route::get('task/{id}/edit', [TaskController::class, 'edit'])->name('taskController.edit');
    Route::put('task/update/{id}', [TaskController::class, 'update'])->name('taskController.update');
    Route::delete('task/{id}/delete', [TaskController::class, 'destroy'])->name('taskController.destroy');
    Route::get('all-trash', [TaskController::class, 'allTrashed'])->name('taskController.allTrash');
    Route::get('search/{title?}', [TaskController::class, 'search'])->name('taskController.search');
    Route::get('searchDraft/{title?}', [TaskController::class, 'searchDraft'])->name('taskController.searchDraft');
    Route::get('draft', [TaskController::class, 'draft'])->name('taskController.draft');

});