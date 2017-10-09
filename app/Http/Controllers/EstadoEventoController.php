<?php

namespace App\Http\Controllers;

use App\Models\EstadoEvento;
use Illuminate\Http\Request;

class EstadoEventoController extends ModelController
{

    public function __construct() {
        $this->objecto = new EstadoEvento();
        $this->nomeObjecto = 'EstadoEvento';
        $this->nomeObjectos = 'EstadoEventos';
        $this->relacionados = ['eventos'];
    }

}
