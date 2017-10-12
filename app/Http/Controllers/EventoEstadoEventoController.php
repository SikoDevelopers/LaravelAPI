<?php

namespace App\Http\Controllers;

use App\Models\EventoEstadoEvento;
use Illuminate\Http\Request;

class EventoEstadoEventoController extends ModelController
{
    public function __construct() {
        $this->objecto = new  EventoEstadoEvento();
        $this->nomeObjecto = 'eventoEstadoEvento';
        $this->nomeObjectos = 'eventoEstadoEventos';
        $this->relacionados = [''];
    }
}
