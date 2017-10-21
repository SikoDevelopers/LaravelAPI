<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\TipoUser::class, 4)->create();
        factory(\App\User::class, 40)->create();
        factory(\App\Models\Area::class, 4)->create();
        factory(\App\Models\Funcionario::class, 5)->create();
//        factory(\App\Models\SupervisorExterno::class, 5)->create();
//        factory(\App\Models\AreasSupervisorExterno::class, 10)->create();
        factory(\App\Models\Curso::class, 4)->create();
        factory(\App\Models\Docente::class,20)->create();
        factory(\App\Models\Funcao::class, 4)->create();
        factory(\App\Models\CategoriaFicheiro::class, 2)->create();
        factory(\App\Models\EstadoFicheiro::class, 5)->create();
        factory(\App\Models\CategoriaEvento::class, 2)->create();
        factory(\App\Models\EstadoEvento::class, 3)->create();
        factory(\App\Models\Estudante::class, 10)->create();
        factory(\App\Models\DirectorCurso::class, 4)->create();
        factory(\App\Models\DocenteArea::class,20)->create();
        factory(\App\Models\Tema::class,20)->create();
        factory(\App\Models\Trabalho::class,20)->create();
        factory(\App\Models\DocentesAreasTrabalho::class,20)->create();
        factory(\App\Models\FicheiroReprovado::class,5)->create();
        factory(\App\Models\FicheirosTrabalho::class,20)->create();
        factory(\App\Models\FicheiroTrabalho_EstadoFicheiro::class,20)->create();
        factory(\App\Models\Evento::class,10)->create();
        factory(\App\Models\EventoEstadoEvento::class,10)->create();
    }
}
