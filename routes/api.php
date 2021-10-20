<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OccasionController;
use App\Http\Controllers\API\POSController;
use App\Http\Controllers\API\ProjectApiController;
use App\Http\Controllers\API\RequestsController;
use App\Http\Controllers\API\RoadPlanController;
use App\Http\Controllers\API\VisitsController;
use App\Http\Controllers\API\DeveloperAlertsController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;


Route::group(["namespace" => 'API',], function (Router $api) {
    Route::get('error_codes', [ProjectApiController::class, 'error_codes']);
    Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
    Route::group(['middleware' => ['auth.jwt']], function () {
        Route::get('reports', [OccasionController::class, 'reports']);
        Route::get('occasion', [OccasionController::class, 'occasion']);
        Route::get('visitors', [OccasionController::class, 'visitors']);
        Route::post('change_status', [OccasionController::class, 'change_status']);

        Route::post('auth/changePassword', [AuthController::class, 'changePassword']);
        Route::post('auth/me', [AuthController::class, 'me']);
    });

});
