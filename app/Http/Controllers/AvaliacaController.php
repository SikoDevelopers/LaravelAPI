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


    public function salvarTransacao(Request $objectos) {

//        return ['avaliacao' => $objectos->all()];

//        $this->validate($objectos, [
//            'fase' => 'required',
//            'docentes_id' => 'required',
//            'data_limite' => 'required',
//            'data' => 'required',
//            'id' => 'required'
//        ]);

        DB::beginTransaction();

        if(! $avaliacao = Avaliacoes::create($objectos->avaliacao)) {
            DB::rollBack();
            return Auxiliar::retornarErros('Erro ao criar avaliacao');
        }
        else
            if(! $ficheirosTrabalho = FicheirosTrabalho::find($objectos->avaliacao['id'])->update(['avaliacoes_id' => $avaliacao->id])) {
                DB::rollBack();
                return Auxiliar::retornarErros('Erro ao actualizar a tabela Ficheiros_trablhos');
            }
            else{
                DB::commit();

                $trabalhoCompleto = Trabalho::find($objectos->protocolo['trabalho_id'])->first();
                $emailUser = User::find($objectos->avaliadorSelecionado['users_id'])->first()['email'];
                $mail = [
                    'nome'=>$objectos->avaliadorSelecionado['nome'] .' '. $objectos->avaliadorSelecionado['apelido'],
                    'estudante' => $trabalhoCompleto->estudante->nome,
                    'trabalho' => $trabalhoCompleto->titulo,
                    'email' => $emailUser
                ];
//
//                $controller = new emailController();
//                $objectos->request->add($mail);
//                return ['avaliacao' => $controller->enviarParticipante($objectos)];
            }
//            return ['avaliacao' => $trabalhoCompleto, 'user'=>$emailUser];
//            return [$trabalhoCompleto, $emailUser];
//        return redirect()->route('avaliacao_ficheiro', ['id' => $objectos->get('id')]);
        return response()->json(['avaliacao' => $avaliacao, 'ficeiros_trabalho'=>$ficheirosTrabalho]);
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
