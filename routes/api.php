<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;

use App\Models\PointImage;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getServices', [UserController::class, 'getServices']);
Route::post('uploadInformation', [UserController::class, 'uploadInformation']);
Route::post('uploadInformations', [UserController::class, 'uploadInformations']);

Route::get('getPoints/{id}', [MainController::class, 'getPoints']);

Route::post('savePointOffline', [MainController::class, 'savePointOffline']);


Route::post('/upload-files/{id}' , function(Request $r,$id){
    $file      = $r->file;
    $path      = public_path().'/uploads/points/'.$id.'/images';
    $name_file = md5(uniqid().rand(1000,9999)).'.'.$r->file->getClientOriginalExtension();
    $token     = $r->token_image;
    $file->move($path,$name_file);

    $pi = new PointImage;
    $pi->point_id = $id;
    $pi->image = $name_file;
    $pi->key       = $token;
    $pi->save();
    
    return 1;
});

Route::post('/deleteFileGallery', function(Request $r) {
    $f = PointImage::where('key' , $r->file)->first();
    @unlink($f->file);
    $f->delete();

    return 1;
});