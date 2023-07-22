<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;
//function () {return view ('dashboard');

   Route::group([
    //'middleware' => ['auth'] ,
    'as'         => 'dashboard.',
    'prefix'  => 'dashboard',
    'namespace'  => 'App\Http\Controllers'
   ] , function() {
    Route::get('/','DashboardController@index')
    ->name('dashboard');

    Route::get('/categories/trash' , [CategoriesController::class , 'trash'])
     ->name('categories.trash');

    Route::put('/categories/{category}/restore' , [CategoriesController::class , 'restore'])
     ->name('categories.restore');

    Route::delete('/categories/{category}/force-delete',[CategoriesController::class , 'forceDelete'])
     ->name('categories.force-delete');

    Route::resource('/categories' , CategoriesController::class);
   });



