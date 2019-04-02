<?php

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

/*
Route::get('/', function () {
    return view('welcome', 'TaskController@index'); // taskc@index wordt opgeroepen zodat we de tabel kunnen inladen bij het reloaden van de website
});
*/
// dit roept de index op, die dat stuurt naar de taskcontroller (ga naar Taskcontroller.php)
Route::get('/', 'TaskController@index');

//hier hebben we een route toegevoegd zodat we de tasks kunnen doen
// https://laravel.com/docs/5.8/routing

Route::post('/createTask', [
    'uses' => 'TaskController@store',
    'as' => 'createTask',
]);


Route::get('/deleteTask/{task_id}', [ //task_id wordt meegegeven in de view
    'uses' => 'TaskController@destroy', //destroy wordt opgeroepen
    'as' => 'deleteTask',
]);


