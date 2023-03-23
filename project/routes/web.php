<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GradeController;

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

// fetch and view all
Route::get('/', [Controller::class,'index'])->name('dahboard');

Route::get('/students', [StudentController::class,'index'])->name('list.student');

Route::get('/grade', [GradeController::class,'index'])->name('list.grade');

// // create and upload
// Route::get('video-upload', [
//     VideoController::class,
//     'create'
// ])->name('video.upload');
// Route::post('video-upload', [
//     VideoController::class,
//     'store'
// ])->name('store.video');

// // view a video
// Route::get('video-view/{id}', [
//     VideoController::class,
//     'show'
// ])->name('view.video');

// // edit a video
// Route::get('video-edit/{id}', [
//     VideoController::class,
//     'edit'
// ])->name('edit.video');
// Route::post('video-edit/{id}', [
//     VideoController::class,
//     'update'
// ])->name('update.video');

// // delete a video
// Route::get('video-delete/{id}', [
//     VideoController::class,
//     'destroy'
// ])->name('delete.video');
