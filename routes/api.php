<?php

use Illuminate\Http\Request;

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

/**
 * Rotas para estudantes
 */
Route::prefix('estudante')->group(function(){
    Route::get('listar', 'EstudanteController@listar');
    Route::post('salvar', 'EstudanteController@salvar');
    Route::put('editar/{id}', 'EstudanteController@editar');
    Route::get('pesquisar/{id}', 'EstudanteController@pesquisar');
    Route::delete('remover/{id}', 'EstudanteController@remover');
    Route::get('buscarUltimo', 'EstudanteController@buscarUltimo');
});


