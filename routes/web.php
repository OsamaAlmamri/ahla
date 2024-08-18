<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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


Route::get('download_app', function () {
    //  $id = setting('app_link');
    $headers = [
        'Content-Type:' => 'application/apk',
    ];
    $path = 'POS_Sabafon_v0.1.0.apk';
    $pathToFile = public_path($path);
//        $file_name = ($file_name = $ass->originalName);
    return response()->download($pathToFile, Str::ascii($path, 'en'), $headers);

})->name('download_app');

Route::get('/test', 'ArtisanCommandsController@test');
Route::Any('/fsm', 'ArtisanCommandsController@fsm');
Route::get('/test2', 'ArtisanCommandsController@test_normal_php');

Route::get('/migrate', 'ArtisanCommandsController@migrate');
Route::get('/role_seed', 'ArtisanCommandsController@role_seed');
Route::get('/clear', 'ArtisanCommandsController@clearCache');
Route::get('/optimize', 'ArtisanCommandsController@optimizeCache');
Route::get('/rout_cache', 'ArtisanCommandsController@routeCache');
Route::get('/clear_compiled', 'ArtisanCommandsController@clearCompiled');
Route::get('/storage_link', 'ArtisanCommandsController@storageLnk');
//Route::get('/info', 'ArtisanCommandsController@shoInfo');
//Route::get('/envis', 'ArtisanCommandsController@envIs');
//Route::get('/telspub', 'ArtisanCommandsController@telspub');

Auth::routes();

//Route::get('/', function () {
//    return redirect('/dashboard');
//})->name('home');
//

