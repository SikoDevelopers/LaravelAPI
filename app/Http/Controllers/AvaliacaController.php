<?php

namespace App\Http\Controllers;

use App\Http\Controllers\classesAuxiliares\Auxiliar;
use App\Models\Area;
use App\Models\Avaliacoes;
use App\Models\Docente;
use App\Models\FicheirosTrabalho;
use App\Models\Trabalho;
use App\User;
use Illuminate\Http\Request;
use \DB;

class AvaliacaController extends ModelController
{


    public function __construct() {
        $this->objecto = new Avaliacoes();
        $this->nomeObjecto = 'avaliacao';
        $this->nomeObjectos = 'avaliacoes';
        $this->relacionados = ['docentes'];
    }


    public function salvarTransacao(Request $request) {

//        return ['avaliacao' => $objectos->all()];

//        $this->validate($objectos, [
//            'fase' => 'required',
//            'docentes_id' => 'required',
//            'data_limite' => 'required',
//            'data' => 'required',
//            'id' => 'required'
//        ]);

        DB::beginTransaction();

        if(! $avaliacao = Avaliacoes::create($request->avaliacao)) {
            DB::rollBack();
            return Auxiliar::retornarErros('Erro ao criar avaliacao');
        }
        else
            if(! $ficheirosTrabalho = FicheirosTrabalho::find($request->avaliacao['id'])->update(['avaliacoes_id' => $avaliacao->id])) {
                DB::rollBack();
                return Auxiliar::retornarErros('Erro ao actualizar a tabela Ficheiros_trablhos');
            }
            else{
                DB::commit();

                $trabalhoCompleto = Trabalho::find($request->protocolo['trabalho_id'])->first();
                $emailUser = User::find($request->avaliadorSelecionado['users_id'])['email'];

                $email = [
                    'nome'=>$request->avaliadorSelecionado['nome'] .' '. $request->avaliadorSelecionado['apelido'],
                    'estudante' => $trabalhoCompleto->estudante->nome,
                    'trabalho' => $trabalhoCompleto->titulo,
                    'email' => $emailUser
                ];

                $controller = new emailController();
                $request->request->add($email);
                $controller->enviarParticipante($request);
            }
        return redirect()->route('avaliacao_ficheiro', ['id' => $request->avaliacao['id']]);
    }


    public function removerAvaliacao($idAvaliacao, Request $idFicheiroTrabalho) {
        DB::beginTransaction();

//        return ['idFicheiro' => $idFicheiroTrabalho->all(), 'Avaliacao' => $idAvaliacao];

        if(!FicheirosTrabalho::find($idFicheiroTrabalho->get('ficheiroTrabalho_id'))->update(['avaliacoes_id' => null])){
            DB::rollBack();
            return Auxiliar::retornarErros('Erro ao Actualizar Ficheiro Trabalho');
        }else
            if(!Avaliacoes::find($idAvaliacao)->delete()){
                DB::rollBack();
                return Auxiliar::retornarErros('Erro ao Deletar Avaliacao');
            }

        DB::commit();
        return Auxiliar::retornarDados('resultado', true, 200);
    }


}
