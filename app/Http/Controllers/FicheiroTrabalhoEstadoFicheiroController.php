<?php

namespace App\Http\Controllers;

use App\Models\FicheiroTrabalho_EstadoFicheiro;
use Illuminate\Http\Request;

class FicheiroTrabalhoEstadoFicheiroController extends ModelController
{

    public function __construct() {
        $this->objecto = new   FicheiroTrabalho_EstadoFicheiro();
        $this->nomeObjecto = 'ficheiroTrabalho_EstadoFicheiro';
        $this->nomeObjectos = 'ficheiroTrabalho_EstadoFicheiro';
        $this->relacionados = ['categoriaFicheiro','trabalho','estadoFicheiros','ficheiroReprovado'];
    }
}
