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


/**
* Rotas para areas
*/
    Route::get('areas', 'AreaController@listar');
//  Route::get('areas/{id}/docentes', 'AreaController@trabalhos');
//  Route::get('areas/{id}/cursos', 'AreaController@cursos');
    Route::post('areas', 'AreaController@salvar');
    Route::put('areas/{id}', 'AreaController@editar');
    Route::get('areas/{id}', 'AreaController@pesquisar');
    Route::delete('areas/{id}', 'AreaController@remover');


/**
* Rotas para Area Supervisor Externo
*/
    Route::get('area_supervisor_externos', 'AreaSupervisorExternoController@listar');
//  Route::get('area_supervisor_externos/{id}/docentes', 'AreaSupervisorExternoController@trabalhos');
//  Route::get('area_supervisor_externos/{id}/cursos', 'AreaSupervisorExternoController@cursos');
    Route::post('area_supervisor_externos', 'AreaSupervisorExternoController@salvar');
    Route::put('area_supervisor_externos/{id}', 'AreaSupervisorExternoController@editar');
    Route::get('area_supervisor_externos/{id}', 'AreaSupervisorExternoController@pesquisar');
    Route::delete('area_supervisor_externos/{id}', 'AreaSupervisorExternoController@remover');


/**
* Rotas para Categoria Evento
*/
    Route::get('categoria_eventos', 'CategoriaEventoController@listar');
//  Route::get('categoria_eventos/{id}/docentes', 'CategoriaEventoController@trabalhos');
//  Route::get('categoria_eventos/{id}/cursos', 'CategoriaEventoController@cursos');
    Route::post('categoria_eventos', 'CategoriaEventoController@salvar');
    Route::put('categoria_eventos/{id}', 'CategoriaEventoController@editar');
    Route::get('categoria_eventos/{id}', 'CategoriaEventoController@pesquisar');
    Route::delete('categoria_eventos/{id}', 'CategoriaEventoController@remover');


/**
* Rotas para Categoria Ficheiro
*/
    Route::get('categoria_ficheiros', 'CategoriaFicheiroController@listar');
//  Route::get('categoria_ficheiros/{id}/docentes', 'CategoriaFicheiroController@trabalhos');
//  Route::get('categoria_ficheiros/{id}/cursos', 'CategoriaFicheiroController@cursos');
    Route::post('categoria_ficheiros', 'CategoriaFicheiroController@salvar');
    Route::put('categoria_ficheiros/{id}', 'CategoriaFicheiroController@editar');
    Route::get('categoria_ficheiros/{id}', 'CategoriaFicheiroController@pesquisar');
    Route::delete('categoria_ficheiros/{id}', 'CategoriaFicheiroController@remover');



/**
* Rotas para Curso
*/
    Route::get('cursos', 'CursoController@listar');
//  Route::get('cursos/{id}/docentes', 'CursoController@trabalhos');
//  Route::get('cursos/{id}/cursos', 'CursoController@cursos');
    Route::post('cursos', 'CursoController@salvar');
    Route::put('cursos/{id}', 'CursoController@editar');
    Route::get('cursos/{id}', 'CursoController@pesquisar');
    Route::delete('cursos/{id}', 'CursoController@remover');

/**
* Rotas para Director Curso
*/
    Route::get('director_curso', 'DirectorCursoController@listar');
//  Route::get('director_curso/{id}/docentes', 'DirectorCursoController@trabalhos');
//  Route::get('director_curso/{id}/curso', 'DirectorCursoController@cursos');
    Route::post('director_curso', 'DirectorCursoController@salvar');
    Route::put('director_curso/{id}', 'DirectorCursoController@editar');
    Route::get('director_curso/{id}', 'DirectorCursoController@pesquisar');
    Route::delete('director_curso/{id}', 'DirectorCursoController@remover');

/**
* Rotas para Docente Area
*/
    Route::get('docente_area', 'DocenteAreaController@listar');
//  Route::get('docente_area/{id}/docentes', 'DocenteAreaController@trabalhos');
//  Route::get('docente_area/{id}/curso', 'DocenteAreaController@cursos');
    Route::post('docente_area', 'DocenteAreaController@salvar');
    Route::put('docente_area/{id}', 'DocenteAreaController@editar');
    Route::get('docente_area/{id}', 'DocenteAreaController@pesquisar');
    Route::delete('docente_area/{id}', 'DocenteAreaController@remover');

/**
* Rotas para Docentes Areas Trabalho
*/
    Route::get('docentes_areas_trabalhos', 'DocenteAreaTrabalhoController@listar');
//  Route::get('docentes_areas_trabalhos/{id}/docentes', 'DocenteAreaTrabalhoController@trabalhos');
//  Route::get('docentes_areas_trabalhos/{id}/curso', 'DocenteAreaTrabalhoController@cursos');
    Route::post('docentes_areas_trabalhos', 'DocenteAreaTrabalhoController@salvar');
    Route::put('docentes_areas_trabalhos/{id}', 'DocenteAreaTrabalhoController@editar');
    Route::get('docentes_areas_trabalhos/{id}', 'DocenteAreaTrabalhoController@pesquisar');
    Route::delete('docentes_areas_trabalhos/{id}', 'DocenteAreaTrabalhoController@remover');


/**
* Rotas para Estado Evento
*/
    Route::get('estado_eventos', 'EstadoEventoController@listar');
//  Route::get('estado_eventos/{id}/docentes', 'EstadoEventoController@trabalhos');
//  Route::get('estado_eventos/{id}/curso', 'EstadoEventoController@cursos');
    Route::post('estado_eventos', 'EstadoEventoController@salvar');
    Route::put('estado_eventos/{id}', 'EstadoEventoController@editar');
    Route::get('estado_eventos/{id}', 'EstadoEventoController@pesquisar');
    Route::delete('estado_eventos/{id}', 'EstadoEventoController@remover');


/**
* Rotas para Estado Ficheiro
*/
    Route::get('estado_ficheiros', 'EstadoFicheiroController@listar');
//  Route::get('estado_ficheiros/{id}/docentes', 'EstadoFicheiroController@trabalhos');
//  Route::get('estado_ficheiros/{id}/curso', 'EstadoFicheiroController@cursos');
    Route::post('estado_ficheiros', 'EstadoFicheiroController@salvar');
    Route::put('estado_ficheiros/{id}', 'EstadoFicheiroController@editar');
    Route::get('estado_ficheiros/{id}', 'EstadoFicheiroController@pesquisar');
    Route::delete('estado_ficheiros/{id}', 'EstadoFicheiroController@remover');


/**
* Rotas para Evento
*/
    Route::get('eventos', 'EventoController@listar');
//  Route::get('eventos/{id}/docentes', 'EventoController@trabalhos');
//  Route::get('eventos/{id}/curso', 'EventoController@cursos');
    Route::post('eventos', 'EventoController@salvar');
    Route::put('eventos/{id}', 'EventoController@editar');
    Route::get('eventos/{id}', 'EventoController@pesquisar');
    Route::delete('eventos/{id}', 'EventoController@remover');


/**
* Rotas para Eventos EstadoEvento
*/
    Route::get('evento_estado_eventos', 'EventoEstadoEventoController@listar');
//  Route::get('evento_estado_eventos/{id}/docentes', 'EventoEstadoEventoController@trabalhos');
//  Route::get('evento_estado_eventos/{id}/curso', 'EventoEstadoEventoController@cursos');
    Route::post('evento_estado_eventos', 'EventoEstadoEventoController@salvar');
    Route::put('evento_estado_eventos/{id}', 'EventoEstadoEventoController@editar');
    Route::get('evento_estado_eventos/{id}', 'EventoEstadoEventoController@pesquisar');
    Route::delete('evento_estado_eventos/{id}', 'EventoEstadoEventoController@remover');


/**
* Rotas para Ficheiro Reprovado
*/
    Route::get('ficheiro_reprovados', 'FicheiroReprovadoController@listar');
//  Route::get('ficheiro_reprovados/{id}/docentes', 'FicheiroReprovadoController@trabalhos');
//  Route::get('ficheiro_reprovados/{id}/curso', 'FicheiroReprovadoController@cursos');
    Route::post('ficheiro_reprovados', 'FicheiroReprovadoController@salvar');
    Route::put('ficheiro_reprovados/{id}', 'FicheiroReprovadoController@editar');
    Route::get('ficheiro_reprovados/{id}', 'FicheiroReprovadoController@pesquisar');
    Route::delete('ficheiro_reprovados/{id}', 'FicheiroReprovadoController@remover');

/**
* Rotas para Ficheiros Trabalho
*/
    Route::get('ficheiros_trabalhos', 'FicheiroTrabalhoController@listar');
//  Route::get('ficheiros_trabalhos/{id}/docentes', 'FicheiroTrabalhoController@trabalhos');
//  Route::get('ficheiros_trabalhos/{id}/curso', 'FicheiroTrabalhoController@cursos');
    Route::post('ficheiros_trabalhos', 'FicheiroTrabalhoController@salvar');
    Route::put('ficheiros_trabalhos/{id}', 'FicheiroTrabalhoController@editar');
    Route::get('ficheiros_trabalhos/{id}', 'FicheiroTrabalhoController@pesquisar');
    Route::delete('ficheiros_trabalhos/{id}', 'FicheiroTrabalhoController@remover');


/**
* Rotas para FicheiroTrabalho_EstadoFicheiro
*/
    Route::get('Ficheiro_trabalho_estado_ficheiros', 'FicheiroTrabalhoEstadoFicheiroController@listar');
//  Route::get('Ficheiro_trabalho_estado_ficheiros/{id}/docentes', 'FicheiroTrabalhoEstadoFicheiroController@trabalhos');
//  Route::get('Ficheiro_trabalho_estado_ficheiros/{id}/curso', 'FicheiroTrabalhoEstadoFicheiroController@cursos');
    Route::post('Ficheiro_trabalho_estado_ficheiros', 'FicheiroTrabalhoEstadoFicheiroController@salvar');
    Route::put('Ficheiro_trabalho_estado_ficheiros/{id}', 'FicheiroTrabalhoEstadoFicheiroController@editar');
    Route::get('Ficheiro_trabalho_estado_ficheiros/{id}', 'FicheiroTrabalhoEstadoFicheiroController@pesquisar');
    Route::delete('Ficheiro_trabalho_estado_ficheiros/{id}', 'FicheiroTrabalhoEstadoFicheiroController@remover');


/**
* Rotas para Funcionario
*/
    Route::get('funcionarios', 'FuncionarioController@listar');
//  Route::get('funcionarios/{id}/docentes', 'FuncionarioController@trabalhos');
//  Route::get('funcionarios/{id}/curso', 'FuncionarioController@cursos');
    Route::post('funcionarios', 'FuncionarioController@salvar');
    Route::put('funcionarios/{id}', 'FuncionarioController@editar');
    Route::get('funcionarios/{id}', 'FuncionarioController@pesquisar');
    Route::delete('funcionarios/{id}', 'FuncionarioController@remover');

/**
* Rotas para Funcao
*/
    Route::get('funcoes', 'FuncaoController@listar');
//  Route::get('funcoes/{id}/docentes', 'FuncaoController@trabalhos');
//  Route::get('funcoes/{id}/curso', 'FuncaoController@cursos');
    Route::post('funcoes', 'FuncaoController@salvar');
    Route::put('funcoes/{id}', 'FuncaoController@editar');
    Route::get('funcoes/{id}', 'FuncaoController@pesquisar');
    Route::delete('funcoes/{id}', 'FuncaoController@remover');

/**
* Rotas para SupervisorExterno
*/
    Route::get('supervisor_externos', 'SupervisorExternoController@listar');
//  Route::get('supervisor_externos/{id}/docentes', 'SupervisorExternoController@trabalhos');
//  Route::get('supervisor_externos/{id}/curso', 'SupervisorExternoController@cursos');
    Route::post('supervisor_externos', 'SupervisorExternoController@salvar');
    Route::put('supervisor_externos/{id}', 'SupervisorExternoController@editar');
    Route::get('supervisor_externos/{id}', 'SupervisorExternoController@pesquisar');
    Route::delete('supervisor_externos/{id}', 'SupervisorExternoController@remover');

/**
* Rotas para Tema
*/
    Route::get('temas', 'TemaController@listar');
//  Route::get('temas/{id}/docentes', 'TemaController@trabalhos');
//  Route::get('temas/{id}/curso', 'TemaController@cursos');
    Route::post('temas', 'TemaController@salvar');
    Route::put('temas/{id}', 'TemaController@editar');
    Route::get('temas/{id}', 'TemaController@pesquisar');
    Route::delete('temas/{id}', 'TemaController@remover');

/**
* Rotas para TipoUser
*/
    Route::get('tipo_users', 'TipoUserController@listar');
//  Route::get('tipo_users/{id}/docentes', 'TipoUserController@trabalhos');
//  Route::get('tipo_users/{id}/curso', 'TipoUserController@cursos');
    Route::post('tipo_users', 'TipoUserController@salvar');
    Route::put('tipo_users/{id}', 'TipoUserController@editar');
    Route::get('tipo_users/{id}', 'TipoUserController@pesquisar');
    Route::delete('tipo_users/{id}', 'TipoUserController@remover');

/**
* Rotas para Trabalho
*/
    Route::get('trabalhos', 'TrabalhoController@listar');
//  Route::get('trabalhos/{id}/docentes', 'TrabalhoController@trabalhos');
//  Route::get('trabalhos/{id}/curso', 'TrabalhoController@cursos');
    Route::post('trabalhos', 'TrabalhoController@salvar');
    Route::put('trabalhos/{id}', 'TrabalhoController@editar');
    Route::get('trabalhos/{id}', 'TrabalhoController@pesquisar');
    Route::delete('trabalhos/{id}', 'TrabalhoController@remover');









