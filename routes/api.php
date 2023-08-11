<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Antrenman\DenemeController;
use App\Http\Controllers\firmalar;
use App\Http\Controllers\GonderIleti;
use App\Http\Controllers\ilce_controller;
use App\Http\Controllers\sehir_controller;
use App\Http\Controllers\MailGonder;
use App\Http\Controllers\project;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// get items
Route::get('/endpoints/deneme', [DenemeController::class, 'index']);

// get item
Route::get('/endpoints/deneme/{id}', [DenemeController::class, 'show']);

// update item
Route::put('/endpoints/deneme/{id}', [DenemeController::class, 'update']);

// delete item
Route::delete('/endpoints/deneme/{id}', [DenemeController::class, 'destroy']);

//post item
/*
Bu Laravel rota tanımı, /endpoints/deneme yoluna yapılan HTTP POST isteklerini
 DenemeController içindeki store metoduna yönlendiren bir route'u tanımlar
*/
Route::post('/endpoints/deneme', [DenemeController::class, 'store']);


//-***********

Route::get('/sehirler', [sehir_controller::class, 'index']);

Route::get('/sehirler/{id}', [sehir_controller::class, 'show']);


//-****************
Route::get('/ilceler/{id}',[ilce_controller::class, 'show']);


//mail gönderme işlemi için mail_gonder isimli controllerı tetikleyecek route

Route::post('/gonder-ileti',[GonderIleti::class,'MsjGonder']);


Route::get('firmalar/{id}',[firmalar::class,'showEsler']);



Route::get('projeler/{id}/isler',[project::class,'getIssue']);
