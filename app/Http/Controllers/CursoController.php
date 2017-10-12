<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends ModelController
{

    public function __construct() {
        $this->objecto = new  Curso();
        $this->nomeObjecto = 'curso';
        $this->nomeObjectos = 'cursos';
        $this->relacionados = ['estudantes', 'directorCurso'];
    }
}
