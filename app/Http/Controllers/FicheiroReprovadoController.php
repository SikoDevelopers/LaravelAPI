<?php

namespace App\Http\Controllers;

use App\Models\FicheiroReprovado;
use Illuminate\Http\Request;

class FicheiroReprovadoController extends ModelController
{
    public function __construct() {
        $this->objecto = new  FicheiroReprovado();
        $this->nomeObjecto = ' FicheiroReprovado';
        $this->nomeObjectos = ' FicheiroReprovados';
        $this->relacionados = ['ficheirosTrabalho'];
    }
}
