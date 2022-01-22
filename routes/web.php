<?php

use Illuminate\Support\Facades\Route;

Route::match(array('GET', 'POST'), '/', function(){
    return view('test');
});
Route::get( '/rssXml', function(){
    return view('rssXml');
});
