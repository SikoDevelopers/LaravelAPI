<?php

namespace App\Http\Controllers;

use App\Models\FicheiroTrabalho_EstadoFicheiro;
use Illuminate\Http\Request;

class FicheiroTrabalhoEstadoFicheiroController extends ModelController
{

    public function __construct() {
        $this->objecto = new   FicheiroTrabalho_EstadoFicheiro();
        $this->nomeObjecto = ' FicheiroTrabalho_EstadoFicheiro';
        $this->nomeObjectos = ' FicheiroTrabalho_EstadoFicheiro';
        $this->relacionados = ['categoriaFicheiro','trabalho','estadoFicheiros','ficheiroReprovado'];
    }
}
