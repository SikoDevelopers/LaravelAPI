<?php

namespace App\Http\Controllers;

use App\Models\DocentesAreasTrabalho;
use Illuminate\Http\Request;

class DocenteAreaTrabalhoController extends ModelController
{

    public function __construct() {
        $this->objecto = new  DocentesAreasTrabalho();
        $this->nomeObjecto = 'docentesAreasTrabalho';
        $this->nomeObjectos = 'docentesAreasTrabalhos';
        $this->relacionados = ['funcao'];
    }
}
