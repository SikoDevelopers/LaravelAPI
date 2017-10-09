<?php

namespace App\Http\Controllers;

use App\Models\DocentesAreasTrabalho;
use Illuminate\Http\Request;

class DocenteAreaTrabalhoController extends ModelController
{

    public function __construct() {
        $this->objecto = new  DocentesAreasTrabalho();
        $this->nomeObjecto = ' DocentesAreasTrabalho';
        $this->nomeObjectos = ' DocentesAreasTrabalhos';
        $this->relacionados = ['funcao'];
    }
}
