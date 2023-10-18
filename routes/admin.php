<?php

use App\Http\Controllers\admin\SpeciePhotosController;
use App\Http\Controllers\admin\FamiliesController;
use App\Http\Controllers\admin\SpecieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/',[AdminController::class,'index'])->name('admin.index');

Route::resource('families',FamiliesController::class)->names('admin.families');
Route::resource('species', SpecieController::class)->names('admin.species');
Route::resource('speciephotos', SpeciePhotosController::class)->names('admin.speciephotos');

?>