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
 * Rotas para criacao de contas
 */
    Route::post('docentes/signup', ['uses' => 'DocenteController@salvarTransacao']);


/**
 * Rota para Login
 */
    Route::post('users/login', 'UserController@login');


/**
 * Rotas para Users
 */
    Route::get('user', 'UserController@getUser');



/**
 * Rotas para estudantes
 */


    Route::get('estudantes', 'EstudanteController@listar')->middleware('autenticado');;
    Route::get('estudantes/{id}/trabalhos', 'EstudanteController@trabalhos');
    Route::get('estudantes/{id}/cursos', 'EstudanteController@cursos');
    Route::post('estudantes', 'EstudanteController@salvarTransacao');
    Route::put('estudantes/{id}', 'EstudanteController@editar');
    Route::get('estudantes/{id}', 'EstudanteController@pesquisar');
    Route::delete('estudantes/{id}', 'EstudanteController@remover');


/**
 * Rotas para docentes
 */
    Route::get('docentes', 'DocenteController@listar');
    Route::get('docentes/{id}/trabalhos', 'DocenteController@trabalhos');
    Route::get('docentes/{id}/cursos', 'DocenteController@cursos');
    Route::post('docentes', 'DocenteController@salvarTransacao');
    Route::put('docentes/{id}', 'DocenteController@editar');
    Route::get('docentes/{id}', 'DocenteController@pesquisar');
    Route::delete('docentes/{id}', 'DocenteController@remover');










