<?php

namespace App\Http\Controllers;

use App\Models\Trabalho;
use Illuminate\Http\Request;

class TrabalhoController extends ModelController
{

    public function __construct() {
        $this->objecto = new   Trabalho();
        $this->nomeObjecto = ' Trabalho';
        $this->nomeObjectos = ' Trabalhos';
        $this->relacionados = ['estudante','ficheirosTrabalhos','evento','docenteAreas','evento','docenteAreas','areaSupervisorExterno'];
    }
}
