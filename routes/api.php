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

    Route::get('estudantes', 'EstudanteController@listar');
    Route::get('estudantes/{id}/trabalhos', 'EstudanteController@trabalhos');
    Route::get('estudantes/{id}/cursos', 'EstudanteController@cursos');
    Route::post('estudantes', 'EstudanteController@salvar');
    Route::put('estudantes/{id}', 'EstudanteController@editar');
    Route::get('estudantes/{id}', 'EstudanteController@pesquisar');
    Route::delete('estudantes/{id}', 'EstudanteController@remover');


/**
 * Rotas para docentes
 */
    Route::get('docentes', 'DocenteController@listar');
    Route::get('docentes/{id}/trabalhos', 'DocenteController@trabalhos');
    Route::get('docentes/{id}/cursos', 'DocenteController@cursos');
    Route::post('docentes', 'DocenteController@salvar');
    Route::put('docentes/{id}', 'DocenteController@editar');
    Route::get('docentes/{id}', 'DocenteController@pesquisar');
    Route::delete('docentes/{id}', 'DocenteController@remover');
