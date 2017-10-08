<?php

namespace App\Http\Controllers;

use App\Models\Estudante;

use Illuminate\Http\Request;


class EstudanteController extends ModelController {



    public function __construct() {
        $this->objecto = new Estudante();
        $this->nomeObjecto = 'estudante';
        $this->nomeObjectos = 'estudantes';
        $this->relacionados = ['trabalho', 'curso'];

    }

    public function listar1(Request $completo) {
        return "Listar";
    }


    /**
     * funcao que salva um conjunto de objectos numa transacao
     * em um eh dependente do outro
     * @param Request[] ...$objectos - conjunto de objectos a serem salvos
     * @return $object - conjunto de objectos salvos
     */
    public function salvarTransacao(Request ...$objectos) {

    }

    /**
     * funcao que pesquisa baseado em varios atributos
     * @param array ...$atributos - conjunto de atributos que serao usados para a pesquisa
     * @return $objecto retornado
     */
    public function pesquisarMuitos(...$atributos) {

    }


    /**
     * busca o ultimo objecto a se adicionado
     * @return $object - ultimo objecto adicionado
     */
    public function buscarUltimo() {
        if (Estudante::count() > 0) {
            $estudante = Estudante::orderBy('created_at', 'desc')->first();
            return Auxiliar::retornarDados('estudante', $estudante, 200);
        }

        return Auxiliar::retornarErros('Nao foi encontrado nenhum estudante', 404);
    }

    /*------------------------------------------------- Metodos adicionais-------------------------------------------------------------------------*/

    /**
     * retorna todos os trabalhos de um estudante
     * @param $idEstudante
     * @return $trabahos
     */
    public function trabalhos($idEstudante){
        $estudante = Estudante::find($idEstudante);

        if($estudante) {
            return Auxiliar::retornarDados('trabalho', $estudante->trabalho, 200);
        }
        return Auxiliar::retornarErros('Estudante nao encontrado', 404);
    }

    /**
     * retorna todos os trabalhos de um estudante
     * @param $idEstudante
     * @return $trabahos
     */
    public function cursos($idEstudante){
        $estudante = Estudante::find($idEstudante);

        if($estudante) {
            return Auxiliar::retornarDados('curso', $estudante->curso, 200);
        }
        return Auxiliar::retornarErros('Estudante nao encontrado', 404);
    }











}
