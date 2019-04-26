<?php
Route::get('/', 'TaskController@index');
Route::get('/overview', 'TaskController@overview');

Route::get('/deleteTask/{task_id}', [ 
    'uses' => 'TaskController@destroy', 
    'as' => 'deleteTask',
]);

Route::get('/markComplete/{task_id}', [
    'uses' => 'TaskController@complete',
    'as' => 'markComplete',
]);

Route::get('/markIncomplete/{task_id}', [
    'uses' => 'TaskController@incomplete',
    'as' => 'markIncomplete',
]);

Route::get('/searchCategory/{category}', [
    'uses' => 'TaskController@searchCategory',
    'as' => 'searchCategory'
]);

Route::post('/createTask', [
    'uses' => 'TaskController@store',
    'as' => 'createTask',
]);

?>


