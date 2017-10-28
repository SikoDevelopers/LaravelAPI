<?php

namespace App\Http\Controllers;

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
}
