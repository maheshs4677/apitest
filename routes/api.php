<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecurringPaymentsAPI;

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

// carbon-offset-schedule end point router, make sure it exposes GET only
// This file is now changed!
Route::get("carbon-offset-schedule", [RecurringPaymentsAPI::class,'index'],['only' => ['index']]);