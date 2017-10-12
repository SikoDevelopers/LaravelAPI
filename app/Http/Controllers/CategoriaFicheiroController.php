<?php

namespace App\Http\Controllers;

use App\Models\CategoriaFicheiro;
use Illuminate\Http\Request;

class CategoriaFicheiroController extends ModelController
{

    public function __construct() {
        $this->objecto = new CategoriaFicheiro();
        $this->nomeObjecto = 'categoriaFicheiro';
        $this->nomeObjectos = 'categoriaFicheiros';
        $this->relacionados = ['ficheirosTrabalhos'];
    }
}
