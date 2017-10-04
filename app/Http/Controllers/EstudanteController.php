<?php

namespace App\Http\Controllers;

use App\Models\Estudante;
use App\Http\Controllers\interfaces\InterfaceController;
use Illuminate\Http\Request;
use App\Http\Controllers\classesAuxiliares\Auxiliar;

class EstudanteController extends Controller implements InterfaceController{

    /**
     * funcao que busca lista de objectos
     * @return lista de todos objectos
     */
    public function listar($ultimo = false) {
        return Auxiliar::retornarDados('estudantes', Estudante::all(), 200);
    }

    /**
     * Salvar um determinado Objecto
     * @param Request $objecto - objecto a ser salvo
     * @return $objecto - objecto se for salvo
     */
    public function salvar(Request $objecto) {
        $estudante = Estudante::create($objecto->all());
        if($estudante)
            return Auxiliar::retornarDados('estudante', $estudante, 200);
        else
            return Auxiliar::retornarErros('Nao foi possivel salvar o estudante', 404);
    }

    /**
     * @param Request $objecto - O objecto a ser actualizado
     * @param $id - a chave primaria do objecto
     * @return $objecto se for actualizado
     */
    public function editar(Request $objecto, $id) {
        $estudante = Estudante::find($id);
        if (!$estudante)
        return Auxiliar::retornarErros('Estudante nao encontrado', 404);

    else {
            $estudante->update($objecto->all());
            return Auxiliar::retornarDados('estudante', $estudante, 200);
        }
    }

    /**
     * @param $id - do objecto pesquisado
     * @return $objecto encontrado
     */
    public function pesquisar($id) {
        $estudante = Estudante::find($id);
        if (!$estudante)
            return Auxiliar::retornarErros('Estudante nao encontrado', 404);
        else
            return Auxiliar::retornarDados('estudante', $estudante, 200);

    }

    /**
     * @param Request $objecto - O objecto a ser removido
     * @param $id - a chave primaria do objecto
     * @return $objecto se for removido
     */
    public function remover(Request $objecto, $id) {
        $estudante = Estudante::find($id);
        if (!$estudante)
            return Auxiliar::retornarErros('Estudante nao encontrado', 404);
        else {
            $estudante->delete();
            return Auxiliar::retornarDados('estudante', $estudante, 200);

        }
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
            $trabalho = $estudante->trabalho();
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
            $curso = $estudante->curso;
            return Auxiliar::retornarDados('curso', $curso, 200);
        }
        return Auxiliar::retornarErros('Estudante nao encontrado', 404);
    }



}
