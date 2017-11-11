<?php

namespace App\Http\Controllers;

use App\Http\Controllers\classesAuxiliares\Auxiliar;
use App\Models\Funcao;
use Illuminate\Http\Request;

class FuncaoController extends ModelController
{

    public function __construct() {
        $this->objecto = new   Funcao();
        $this->nomeObjecto = 'funcao';
        $this->nomeObjectos = 'funcoes';
        $this->relacionados = ['docentesAreasTrabalhos'];
    }

    public function listarRestrito(){
        $funcao = $this->objecto->orWhere('designacao', '=','Oponente')
                                ->orWhere('designacao', '=','Presidente do Juri')->get();
        return Auxiliar::retornarDados('funcoes', $funcao, 200);
    }

}
