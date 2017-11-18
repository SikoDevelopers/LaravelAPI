<?php

namespace App\Http\Controllers;

use App\Http\Controllers\classesAuxiliares\Auxiliar;
use App\Models\Area;
use App\Models\Avaliacoes;
use App\Models\Docente;
use App\Models\FicheirosTrabalho;
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

        $this->validate($objectos, [
            'fase' => 'required',
            'docentes_id' => 'required',
            'data_limite' => 'required',
            'data' => 'required',
            'id' => 'required'
        ]);
        DB::beginTransaction();

        if(! $avaliacao = Avaliacoes::create($objectos->request->all())) {
            DB::rollBack();
            return Auxiliar::retornarErros('Erro ao criar avaliacao');
        }
        else
            if(! $ficheirosTrabalho = FicheirosTrabalho::find($objectos->get('id'))->update(['avaliacoes_id' => $avaliacao->id])) {
                DB::rollBack();
                return Auxiliar::retornarErros('Erro ao actualizar a tabela Ficheiros_trablhos');
            }

        DB::commit();

        return redirect()->route('avaliacao_ficheiro', ['id' => $objectos->get('id')]);
//        return response()->json(['avaliacao' => $avaliacao, 'ficeiros_trabalho'=>$ficheirosTrabalho]);
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
