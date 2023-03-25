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
Route::get('/students/add', [StudentController::class,'create'])->name('add.student');
Route::get('/grade', [GradeController::class,'index'])->name('list.grade');