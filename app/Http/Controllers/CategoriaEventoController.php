<?php

namespace App\Http\Controllers;

use App\Models\CategoriaEvento;
use Illuminate\Http\Request;

class CategoriaEventoController extends ModelController
{

    public function __construct() {
        $this->objecto = new CategoriaEvento();
        $this->nomeObjecto = 'categoriaEvento';
        $this->nomeObjectos = 'categoriaEventos';
        $this->relacionados = ['eventos'];
    }

}
