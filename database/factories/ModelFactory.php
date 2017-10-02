<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


$areas = ['Saude', 'Tecnologia', 'Educacao', 'Analise de sistemas', 'Seguranca', 'Medicina'];
$factory->define(\App\Models\Area::class, function(Faker\Generator $faker) use ($areas){
    return [
        'designacao' => $faker->unique()->randomElement($areas)
    ];
});

$cursos = ['Informatica', 'Matematica', 'Estatistica', 'Ciencias de Informacao Geografica'];
$factory->define(\App\Models\Curso::class, function (Faker\Generator $faker) use ($cursos){
    return [
        'designacao' => $faker->unique()->randomElement($cursos)
    ];

});

$factory->define(\App\Models\Docente::class, function (\Faker\Generator $facker){
    return [
        'nome' => $facker->firstName(),
        'apelido' => $facker->lastName(),
        'sessao' => $facker->text(10)
    ];
});

$funcoes = ['Supervisor', 'Oponente', 'Co-supervisor', 'Juri'];
$factory->define(\App\Models\Funcao::class, function (Faker\Generator $faker) use ($funcoes){
    return [
        'designacao' => $faker->unique()->randomElement($funcoes),
        'descricao' => $faker->text(100)
    ];
});

$categorias = ['Protocolo', 'Trabalho'];
$factory->define(\App\Models\CategoriaFicheiro::class, function (Faker\Generator $faker) use ($categorias){
    return [
        'designacao' => $faker->unique()->randomElement($categorias),
        'descricao' => $faker->text(67),
    ];
});

$estados = ['Pendente', 'Protocolo Submetido', 'Tese Submetida', 'Defesa Marcada', 'Trabalho por Retiticar'];
$factory->define(\App\Models\EstadoFicheiro::class, function(Faker\Generator $faker) use ($estados) {

    return [
        'designacao' => $faker->unique()->randomElement($estados),
        'descricao' => $faker->text(20),
    ];
});

$categoria_eventos = ['Defesa', 'Pre-defesa'];
$factory->define(\App\Models\CategoriaEvento::class, function (Faker\Generator $faker) use ($categoria_eventos){
    return [
        'designacao' => $faker->unique()->randomElement($categoria_eventos),
        'descricao' => $faker->text(20)
    ];
});

$estados_eventos = ['Nao realizado', 'Realizado', 'Decorrendo'];
$factory->define(\App\Models\EstadoEvento::class, function (Faker\Generator $faker) use ($estados_eventos){
    return [
        'designacao' => $faker->unique()->randomElement($estados_eventos),
        'descricao' => $faker->text(20)
    ];
});

$factory->define(\App\Models\Estudante::class, function (Faker\Generator $faker){
    $cursos = \App\Models\Curso::all();

    return [
        'apelido' => $faker->lastName,
        'nome' => $faker->firstName(),
        'data_nascimento' => $faker->dateTime,
        'morada' => substr($faker->address, 0, 40),
        'sessao' => $faker->text(10),
        'cursos_id' => $faker->numberBetween(1, $cursos->count())

    ];

});

$factory->define(\App\Models\DirectorCurso::class, function (Faker\Generator $faker){
    $cursos = \App\Models\Curso::all();

    return [
        'nome' => $faker->unique()->firstName('male'),
        'apelido' => $faker->unique()->lastName,
        'cursos_id' => $faker->unique()->numberBetween(1, $cursos->count()),
    ];
});

$factory->define(\App\Models\DocenteArea::class, function (Faker\Generator $faker){

    return [
        'docentes_id' => $faker->numberBetween(1, \App\Models\Docente::all()->count()),
        'areas_id' => $faker->numberBetween(1, \App\Models\Area::all()->count()),
    ];
});


$factory->define(\App\Models\Tema::class, function (\Faker\Generator $faker){
    return[
        'designacao' => $faker->text(40),
        'docentes_id' => $faker->numberBetween(1, \App\Models\Docente::all()->count()),
        'areas_id' => $faker->numberBetween(1, \App\Models\Area::all()->count())
    ];
});



$factory->define(\App\Models\Trabalho::class, function (\Faker\Generator $faker){
    return [
        'titulo' => $faker->text(20),
        'descricao' => $faker->text(180),
        'estudantes_id' => $faker->numberBetween(1, \App\Models\Estudante::all()->count()),
        'eventos_id' => null,
        'is_aprovado' => false,
    ];
});


$factory->define(\App\Models\DocentesAreasTrabalho::class, function (\Faker\Generator $faker){
    return [
        'docente_areas_id' => $faker->numberBetween(1, \App\Models\DocenteArea::all()->count()),
        'trabalhos_id' => $faker->numberBetween(1, \App\Models\Trabalho::all()->count()),
        'funcoes_id' => $faker->numberBetween(1, \App\Models\Funcao::all()->count())
    ];
});


$factory->define(\App\Models\FicheirosTrabalho::class, function (\Faker\Generator $faker){
    return [
        'caminho' => substr($faker->mimeType, 0, '40'),
        'data' => $faker->dateTime(),
        'categorias_ficheiros_id' => $faker->numberBetween(1, \App\Models\CategoriaFicheiro::all()->count()),
        'trabalhos_id' => $faker->numberBetween(1, \App\Models\Trabalho::all()->count()),
        'ficheiros_reprovados_id' => $faker->optional()->numberBetween(1, \App\Models\FicheiroReprovado::all()->count()),
    ];
});


$factory->define(\App\Models\FicheiroTrabalho_EstadoFicheiro::class, function (\Faker\Generator $faker){
    return [
        'ficheiros_trabalhos_id' => $faker->numberBetween(1, \App\Models\FicheirosTrabalho::all()->count()),
        'estados_ficheiros_id' => $faker->numberBetween(1, \App\Models\EstadoFicheiro::all()->count()),
        'is_actual' => $faker->boolean(90),
        'data' => $faker->dateTime(),
    ];
});

$factory->define(\App\Models\FicheiroReprovado::class, function (\Faker\Generator $faker){
    return [
        'motivo' => $faker->text(40),
        'data_nova_submissao' => $faker->dateTime(),
    ];
});


$factory->define(\App\Models\Evento::class, function (\Faker\Generator $faker){
    return [
        'data_inicio' => $faker->date(),
        'data' => $faker->dateTime(),
        'data_fim' => $faker->date(),
        'local' => $faker->locale,
        'agenda' => $faker->text('40'),
        'hora' => $faker->time(),
        'telefone' => $faker->unique()->phoneNumber,
        'email' => $faker->unique()->email,
        'categorias_eventos_id' => $faker->numberBetween(1, \App\Models\CategoriaEvento::all()->count()),
    ];
});


$factory->define(\App\Models\EventoEstadoEvento::class, function (\Faker\Generator $faker){
    return [
        'estado_eventos_id' => $faker->numberBetween(1, \App\Models\EstadoEvento::all()->count()),
        'eventos_id' => $faker->numberBetween(1, \App\Models\Evento::all()->count()),
    ];
});
