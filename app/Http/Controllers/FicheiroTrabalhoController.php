<?php

namespace App\Http\Controllers;

use App\Models\FicheirosTrabalho;
use Illuminate\Http\Request;

class FicheiroTrabalhoController extends ModelController
{
    public function __construct() {
        $this->objecto = new  FicheirosTrabalho();
        $this->nomeObjecto = 'ficheiroTrabalho';
        $this->nomeObjectos = 'ficheiroTrabalhos';
        $this->relacionados = ['categoriaFicheiro','trabalho','estadoFicheiros','ficheiroReprovado'];
    }
}
