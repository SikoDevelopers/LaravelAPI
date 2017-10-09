<?php

namespace App\Http\Controllers;

use App\Models\EstadoFicheiro;
use Illuminate\Http\Request;

class EstadoFicheiroController extends ModelController
{

    public function __construct() {
        $this->objecto = new EstadoFicheiro();
        $this->nomeObjecto = 'EstadoFicheiro';
        $this->nomeObjectos = 'EstadoFicheiros';
        $this->relacionados = ['ficheirosTrabalhos'];
    }
}
