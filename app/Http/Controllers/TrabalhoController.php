<?php

namespace App\Http\Controllers;

use App\Http\Controllers\classesAuxiliares\Auxiliar;
use App\Models\Area;
use App\Models\Docente;
use App\Models\Trabalho;
use Illuminate\Http\Request;

class TrabalhoController extends ModelController
{

    public function __construct() {
        $this->objecto = new   Trabalho();
        $this->nomeObjecto = 'trabalho';
        $this->nomeObjectos = 'trabalhos';
        $this->relacionados = ['estudante','ficheirosTrabalhos','evento','docenteAreas','areaSupervisorExterno'];
    }


    public function getParticipantesTrabalho($idTrabalho) {

        if ($trabalho = Trabalho::find($idTrabalho)->with('estudante', 'docenteAreas')) {
//            $docentesAreas =  $trabalho->docenteAreas;

//            $area = $trabalho->docenteAreas;
//            $estudante = $trabalho->estudante;

            return response()->json(['trabalho' => $trabalho], 200);
        }
        return response()->json(['trabalho' => $trabalho], 404);
    }

}
