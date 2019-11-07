<?php

use App\Http\Api\Controllers\SubscribeController;
use Illuminate\Http\Request;

Route::post('subscribe', SubscribeController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
