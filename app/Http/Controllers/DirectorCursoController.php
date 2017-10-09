<?php

namespace App\Http\Controllers;

use App\Models\DirectorCurso;
use Illuminate\Http\Request;

class DirectorCursoController extends ModelController
{

    public function __construct() {
        $this->objecto = new  DirectorCurso();
        $this->nomeObjecto = ' DirectorCurso';
        $this->nomeObjectos = ' DirectorCursos';
        $this->relacionados = ['curso', 'user'];
    }
}
