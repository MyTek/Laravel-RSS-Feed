<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/download', function(Request $request){
    return App::call('App\Http\Controllers\RssPdfDownload@download' , ['request' => $request]);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
