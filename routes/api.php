<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RssPdfDownload;
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

//Route::get('/download',function(){
//    return "Test api";
//});
//Route::get('/download', [RssPdfDownload::class, 'download']);
Route::get('/download', function(Request $request){
    return App::call('App\Http\Controllers\RssPdfDownload@download' , ['request' => $request]);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
