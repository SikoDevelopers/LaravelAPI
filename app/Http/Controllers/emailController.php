<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Este controller faz o envio emails para
 * diversas entidades
 *
 * Class emailController
 * @package App\Http\Controllers
 */
class emailController extends Controller
{


    /**
     * Envia um email para confirmacao de
     * supervisao de um determinado supervisor
     *
     *
     * @param Request $request {
     *      nome => Nome do docente ;
     *      estudante=> Nome do estudante;
     *      email => Email do docente;
     *
     * }
     */
    public function enviarSupervisor(Request $request){

       \Mail::send(['text'=>'emails.supervisor'], ['nome'=>$request->nome, 'estudante'=>$request->estudante], function($mensagem) use ($request){
          $mensagem->to($request->email, 'Supervisor')
                   ->subject('Pedido de Supervisao');
          $mensagem->from('comissaocientifica.teste@gmail.com', 'Comissao Cientifica DMI');
       });
    }


    /**
     * Envia um email para um determinado docente
     * que tenha sido asicionado como participante
     * de um determinado trabalho
     *
     * @param Request $request {
     *      nome => Nome do avaliador ;
     *      estudante=> Nome do estudante;
     *      email => Email do avaliador;
     *      trabalho => titulo do trabalho
     *
     * }
     */
    public function enviarParticipante(Request $request){
       return ['avaliacao' => $request->all()];

        \Mail::send(['text'=>'emails.participantes'], ['nome'=>$request->nome, 'estudante'=>$request->estudante,'trabalho'=>$request->trabalho], function($mensagem) use ($request){
            $mensagem->to($request->email, 'Avaliador')
                ->subject('Indicacao para avaliar trabalho');
            $mensagem->from('comissaocientifica.teste@gmail.com', 'Comissao Cientifica DMI');
        });
    }



    /**
     * Envia um email para um determinado estudante
     * logo apos ser avaliado o seu trabalho
     *
     * @param Request $request {
     *      nome => Nome do estudante ;
     *      estudante => Nome do estudante;
     *      docente => Nome do avaliador
     *      email => email do estudante
     * }
     */
    public function enviarEstudante(Request $request){
        \Mail::send(['text'=>'emails.estudante'], ['nome'=>$request->nome, 'docente'=>$request->docente], function($mensagem) use ($request){
            $mensagem->to($request->email, 'Estudante')
                ->subject('Parecer do ultimo ficheiro submetido.');
            $mensagem->from('comissaocientifica.teste@gmail.com', 'Comissao Cientifica DMI');
        });
    }


}
