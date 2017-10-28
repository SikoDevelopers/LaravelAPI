<?php

namespace App\Http\Controllers;

use App\Models\DirectorCurso;

class DirectorCursoController extends ModelController
{

    public function __construct() {
        $this->objecto = new  DirectorCurso();
        $this->nomeObjecto = 'directorCurso';
        $this->nomeObjectos = 'directorCursos';
        $this->relacionados = ['curso', 'user'];
    }
}
