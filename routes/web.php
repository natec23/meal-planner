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
    if(Auth::check()) {
        return redirect('grocery/list/1');
    }
    else {
        return redirect('login');
    }
});

Auth::routes(['register' => false]);

Route::get('/home', function(){
    return redirect('grocery/list/1');
})->name('home');

Route::prefix('grocery')->middleware(['auth'])->group(function () {
    Route::resources([
        'list' => 'Grocery\ListController',
        'item' => 'Grocery\ItemController',
        'category' => 'Grocery\CategoryController'
    ]);
    Route::get('/list/{list}/items', 'Grocery\ListItemController@items');
    Route::put('/list/{list}/item/{item}', 'Grocery\ListItemController@update');
    Route::delete('/list/{list}/item/{item}', 'Grocery\ListItemController@destroy');
});

Route::prefix('recipies')->middleware(['auth'])->group(function () {
    Route::resource('category', 'Recipies\CategoryController', ['as' => 'recipie']);
    Route::resources([
        'recipie' => 'Recipies\RecipieController'
    ]);

    Route::get('/ingredient/{recipie}', 'Recipies\IngredientController@index');
    Route::post('/ingredient/{recipie}', 'Recipies\IngredientController@store');
    Route::put('/ingredient/{ingredient}', 'Recipies\IngredientController@update');
    Route::delete('/ingredient/{ingredient}', 'Recipies\IngredientController@delete');

    Route::get('/direction/{recipie}', 'Recipies\DirectionController@index');
    Route::post('/direction/{recipie}', 'Recipies\DirectionController@store');
    Route::put('/direction/{direction}', 'Recipies\DirectionController@update');
    Route::delete('/direction/{direction}', 'Recipies\DirectionController@delete');
});

Route::middleware(['auth'])->group(function() {
    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::post('change-password', 'ProfileController@changePassword');
});
