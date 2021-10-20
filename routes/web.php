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
Route::Any('/index.php/fsm', 'ArtisanCommandsController@fsm');

Route::get('/', function () {
    return view('welcome');
});
function sendSmsMessage($mobile, $msg)
{
    $url = "http://104.37.188.218/PROFESIONAL/SMG_SND/addSMS_quick";
    $data = http_build_query(array(
        "UserName" => "Pro@prodigy-sys.com",
        "Password" => "343287",
        "CIIDSEQ" => "48",
        "CWID" => "1",
        "CIUTL" => $mobile,
        "CIID" => "CO-SM-48",
        "CIUID" => "SM-48",
        "MAMS" => $msg,
        "MAHE" => "Prodigy system",
        "MAIM" => "1"
    ));
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded",
            'method' => 'POST',
            'content' => $data,
        ),
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}
Route::get('/sendsms/{mobile?}/{$message?}',function ($mobile=773569041,$message=""){
    return sendSmsMessage($mobile, $message) ;
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

Route::get('/', function () {
    return redirect('/dashboard');
})->name('home');


