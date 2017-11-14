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
            'trabalhos_id' => 'required'
        ]);

        DB::beginTransaction();

        if(! $avaliacao = Avaliacoes::create($objectos->request->all())) {
            DB::rollBack();
            return Auxiliar::retornarErros('Erro ao criar avaliacao');
        }
        else
            if(! $ficheirosTrabalho = FicheirosTrabalho::find($objectos->get('trabalhos_id'))->update(['avaliacoes_id' => $avaliacao->id])) {
                DB::rollBack();
                return Auxiliar::retornarErros('Erro ao actualizar a tabela Ficheiros_trablhos');
            }
        else
            DB::commit();

        return response()->json(['avaliacao' => $avaliacao, 'ficeiros_trabalho'=>$ficheirosTrabalho]);
    }


}
