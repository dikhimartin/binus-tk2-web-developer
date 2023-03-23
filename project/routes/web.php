<?php

use Illuminate\Support\Facades\Route;

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


// fetch and view all
// Route::get('/', [
//     VideoController::class,
//     'index'
// ])->name('list.video');

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
