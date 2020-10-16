<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function () {
    return view('welcome');
});


Route::resource('estado', 'Api\\EstadoController');
Route::resource('pessoa', 'Api\\PessoaController');
Route::resource('cliente', 'Api\\ClienteController');
Route::resource('empresa', 'Api\\EmpresaController');
Route::get('empresa/{empresa}/images/logo', 'Api\\EmpresaController@getLogoImage');

Route::prefix('empresa/{empresa}/images/banner')->group(function () {
    Route::get('/', 'Api\\BannerController@index');
});
// Route::resource('teste', 'Teste');
