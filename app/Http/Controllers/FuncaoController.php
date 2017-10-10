<?php

namespace App\Http\Controllers;

use App\Models\Funcao;
use Illuminate\Http\Request;

class FuncaoController extends ModelController
{

    public function __construct() {
        $this->objecto = new   Funcao();
        $this->nomeObjecto = ' Funcao';
        $this->nomeObjectos = ' Funces';
        $this->relacionados = ['docentesAreasTrabalhos'];
    }
}
