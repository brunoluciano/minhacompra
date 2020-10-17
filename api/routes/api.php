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

Route::resource('pessoa', 'Api\\PessoaController');
Route::resource('cliente', 'Api\\ClienteController');
Route::resource('empresa', 'Api\\EmpresaController');

Route::prefix('empresa/{empresa}')->group(function () {
    Route::resource('departamento', 'Api\\DepartamentoController');
    Route::resource('categoria', 'Api\\CategoriaController');
    Route::resource('marca', 'Api\\MarcaController');
    Route::resource('produto', 'Api\\ProdutoController');

    Route::prefix('images')->group(function () {
        Route::get('logo', 'Api\\EmpresaController@getLogoImage');
        Route::resource('banner', 'Api\\BannerController');
        Route::get('banner/{id}/img', 'Api\\BannerController@getBannerImage');
        Route::get('produto/{id}', 'Api\\ProdutoController@getProdutoImage');
    });
});

Route::get('estado', 'Api\\EstadoController@index')->name('estado.index');
Route::get('estado/{id}', 'Api\\EstadoController@show')->name('estado.show');
Route::get('unidademedida', 'Api\\UnidadeMedidaController@index')->name('unidademedida.index');
Route::get('unidademedida/{id}', 'Api\\UnidadeMedidaController@show')->name('unidademedida.show');
