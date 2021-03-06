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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/screvle', 'Api\ScrevleController@index');
Route::get('/ipeecloud','Api\ScrevleController@hmi');

Route::get('/publish', function () {
    // Route logic...

    Redis::publish('test-channel', json_encode(['foo' => 'ba']));
    Redis::publish('flush-channel', json_encode(['pee' => 'flush']));
});
