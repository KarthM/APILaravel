<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\notescontroller;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:api')->get('/user', function (Request $request)
 {
    return $request->user();
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


Route::group(['middleware'=>['Auth:Sanctum']],function()
{
 Route::get('/Note',[notescontroller::class,'index']);
Route::post('/Note',[notescontroller::class,'store']);
Route::get('/Note/{id}',[notescontroller::class,'show']);
Route::put('/Note/{id}',[notescontroller::class,'update']);
Route::delete('/Note/{id}',[notescontroller::class,'destroy']);
Route::post('/logout',[AuthController::class,'logout']);
});