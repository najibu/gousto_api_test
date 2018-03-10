<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::resource('recipes', RecipesController::class);
    Route::get('recipes_by_cuisine/{cuisine}', 'RecipesController@fetchAllByCuisine');
    Route::post('recipes/{id}/rate', 'RatingsController@store');
});
