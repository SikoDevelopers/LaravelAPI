<?php

namespace App\Http\Controllers;

use App\Http\Controllers\classesAuxiliares\Auxiliar;
use App\Models\Trabalho;
use Illuminate\Http\Request;

class TrabalhoController extends ModelController
{

    public function __construct() {
        $this->objecto = new   Trabalho();
        $this->nomeObjecto = 'trabalho';
        $this->nomeObjectos = 'trabalhos';
        $this->relacionados = ['estudante','ficheirosTrabalhos','evento','docenteAreas','evento','docenteAreas','areaSupervisorExterno'];
    }


    public function getParticipantesTrabalho($idTrabalho){

        $trbalho = Trabalho::find($idTrabalho);
        return Auxiliar::retornarDados('trabalho', $trbalho, 200);

    }

}
