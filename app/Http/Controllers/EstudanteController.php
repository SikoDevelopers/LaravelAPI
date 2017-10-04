<?php

namespace App\Http\Controllers;

use App\Models\Estudante;
use App\Models\interfaces\InterfaceController;
use App\Models\interfaces\lista;
use Illuminate\Http\Request;

class EstudanteController extends Controller implements InterfaceController
{

    /**
     * funcao que busca lista de objectos
     * @return lista de todos objectos
     */
    public function listar()
    {
        return response()->json(['estudantes' => Estudante::all()], 200);
    }

    /**
     * Salvar um determinado Objecto
     * @param Request $objecto - objecto a ser salvo
     * @return $objecto - objecto se for salvo
     */
    public function salvar(Request $objecto)
    {
        $estudante = Estudante::create($objecto->all());
        return response()->json(['estudante'=> $estudante], 200);
    }

    /**
     * @param Request $objecto - O objecto a ser actualizado
     * @param $id - a chave primaria do objecto
     * @return $objecto se for actualizado
     */
    public function editar(Request $objecto, $id)
    {
        $estudante = Estudante::find($id);
        if(!$estudante)
            return response()->json(['mensagem' => 'Estudante nao encontrado'], 404);
        else {
            $estudante->update($objecto->all());
            return response()->json(['estudante' => $estudante], 200);
        }
    }

    /**
     * @param $id - do objecto pesquisado
     * @return $objecto encontrado
     */
    public function pesquisar($id)
    {
        $estudante = Estudante::find($id);
        if(!$estudante)
            return response()->json(['mensagem' => 'Estudante nao encontrado'], 404);
        else
            return response()->json(['estudante' => $estudante], 200);
    }

    /**
     * @param Request $objecto - O objecto a ser removido
     * @param $id - a chave primaria do objecto
     * @return $objecto se for removido
     */
    public function remover(Request $objecto, $id)
    {
        $estudante = Estudante::find($id);
        if(!$estudante)
            return response()->json(['mensagem' => $estudante], 404);
        else {
            $estudante->delete();
            return response()->json(['estudante' => $estudante], 200);
        }
    }

    /**
     * funcao que salva um conjunto de objectos numa transacao
     * em um eh dependente do outro
     * @param Request[] ...$objectos - conjunto de objectos a serem salvos
     * @return $object - conjunto de objectos salvos
     */
    public function salvarTransacao(Request ...$objectos)
    {

    }

    /**
     * funcao que pesquisa baseado em varios atributos
     * @param array ...$atributos - conjunto de atributos que serao usados para a pesquisa
     * @return $objecto retornado
     */
    public function pesquisarMuitos(...$atributos)
    {

    }


    /**
     * busca o ultimo objecto a se adicionado
     * @return $object - ultimo objecto adicionado
     */
    public function buscarUltimo()
    {
        if(Estudante::count() > 0 ) {
            $estudante = Estudante::orderBy('created_at', 'desc')->first();
            return response()->json(['estudante' => $estudante],200);
        }

        return response()->json(['mensagem' => 'Nao foi encontrado nenhum estudante'], 404);


    }
}
