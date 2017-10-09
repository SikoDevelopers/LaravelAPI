<?php

namespace App\Http\Controllers\interfaces;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Esta interface eh generica para dos os controllers da aplicacao
 * User: herquiloidehele
 * Date: 10/1/17
 * Time: 17:52
 */

interface InterfaceController{


    /**
     * funcao que busca lista de objectos
     * @param $utilimo - (True or false) Ultimo ou nao
     * @param $completo - especifica se deve ser retornado o objecto com todos
     * os seus objectos relacionados.
     * @return lista de todos objectos
     */
    public function listar(Request $completo);


    /**
     * Salvar um determinado Objecto
     * @param Request $objecto - objecto a ser salvo
     * @return $objecto - objecto se for salvo
     */
    public function salvar(Request $objecto);


    /**
     * @param Request $objecto - O objecto a ser actualizado
     * @param $id - a chave primaria do objecto
     * @return $objecto se for actualizado
     */
    public function editar(Request $objecto, $id);


    /**
     * @param $id - do objecto pesquisado
     * @return $objecto encontrado
     */
    public function pesquisar($id, Request $completo);


    /**
     * @param Request $objecto - O objecto a ser removido
     * @param $id - a chave primaria do objecto
     * @return $objecto se for removido
     */
    public function remover(Request $objecto, $id);


    /**
     * funcao que salva um conjunto de objectos numa transacao
     * em um eh dependente do outro
     * @param Request[] $objectos - conjunto de objectos a serem salvos
     * @return $object - conjunto de objectos salvos
     */
    public function salvarTransacao(Request $objectos);


    /**
     * funcao que pesquisa baseado em varios atributos
     * @param array $atributos - conjunto de atributos que serao usados para a pesquisa
     * @return $objecto retornado
     */
    public function pesquisarMuitos(...$atributos);


    /**
     * busca o ultimo objecto a se adicionado
     * @return $object - ultimo objecto adicionado
     */
    public function buscarUltimo();


}
















