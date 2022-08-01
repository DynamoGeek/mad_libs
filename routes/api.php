<?php

use App\Http\Controllers\MadLibController;
use App\Http\Controllers\MadLibInstanceController;
use Illuminate\Support\Facades\Route;

Route::get('mad_lib', MadLibController::class . '@index');
Route::post('mad_lib', MadLibController::class . '@store');
Route::get('mad_lib/{mad_lib}', MadLibController::class . '@show');

Route::post('mad_lib/{mad_lib}/instance', MadLibInstanceController::class . '@store');
Route::get('mad_lib/{mad_lib}/instance/{mad_lib_instance}', MadLibInstanceController::class . '@show');
Route::patch('mad_lib/{mad_lib}/instance/{mad_lib_instance}', MadLibInstanceController::class . '@update');
Route::get('mad_lib/{mad_lib}/instance/{mad_lib_instance}/output', MadLibInstanceController::class . '@output');
