<?php

use App\Http\Controllers\admin\SpeciePhotosController;
use App\Http\Controllers\admin\FamiliesController;
use App\Http\Controllers\admin\ProcedureTypesController;
use App\Http\Controllers\admin\ResponsiblesController;
use App\Http\Controllers\admin\SpecieController;
use App\Http\Controllers\admin\TreeController;
use App\Http\Controllers\admin\ZonesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/',[AdminController::class,'index'])->name('admin.index');

Route::resource('families',FamiliesController::class)->names('admin.families');
Route::resource('species', SpecieController::class)->names('admin.species');
Route::resource('speciephotos', SpeciePhotosController::class)->names('admin.speciephotos');
Route::resource('trees', TreeController::class)->names('admin.trees');
Route::resource('zones', ZonesController::class)->names('admin.zones');
Route::resource('proceduretypes', ProcedureTypesController::class)->names('admin.proceduretypes');
Route::resource('responsibles', ResponsiblesController::class)->names('admin.responsibles');

?>