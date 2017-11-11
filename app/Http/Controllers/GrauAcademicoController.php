<?php

namespace App\Http\Controllers;

use App\Models\GrauAcademico;
use Illuminate\Http\Request;

class GrauAcademicoController extends ModelController
{


    public function __construct() {
        $this->objecto = new GrauAcademico();
        $this->nomeObjecto = 'grau-academico';
        $this->nomeObjectos = 'grau-academicos';
        $this->relacionados = ['docentes','supervisorExternos', 'temas'];
    }

}
