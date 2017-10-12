<?php

namespace App\Http\Controllers;

use App\Models\EstadoEvento;
use Illuminate\Http\Request;

class EstadoEventoController extends ModelController
{

    public function __construct() {
        $this->objecto = new EstadoEvento();
        $this->nomeObjecto = 'estadoEvento';
        $this->nomeObjectos = 'estadoEventos';
        $this->relacionados = ['eventos'];
    }

}
