<?php

namespace App\Http\Controllers;

use App\Models\EventoEstadoEvento;
use Illuminate\Http\Request;

class EventoEstadoEventoController extends ModelController
{
    public function __construct() {
        $this->objecto = new  EventoEstadoEvento();
        $this->nomeObjecto = ' EventoEstadoEvento';
        $this->nomeObjectos = ' EventoEstadoEventos';
        $this->relacionados = [''];
    }
}
