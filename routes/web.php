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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/store-images', 'HomeController@storeImages');

Route::get('cache-image/{pathkey}/{filename}/{w?}/{h?}', function($pathkey, $filename, $w=100, $h=100){

//    return \Illuminate\Support\Facades\Storage::get("$pathkey/$filename");

    $cacheimage = \Intervention\Image\Facades\Image::cache(function($image) use($pathkey, $filename, $w, $h){

        $filepath = "storage/$pathkey/$filename";
        return $image->make($filepath)->fit(500, 320);

    },10); // cache for 10 minutes

    return response()->make($cacheimage, 200, array('Content-Type' => 'image/jpeg'));
});
