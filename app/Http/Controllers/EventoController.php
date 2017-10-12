<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends ModelController
{
    public function __construct() {
        $this->objecto = new  Evento();
        $this->nomeObjecto = 'evento';
        $this->nomeObjectos = 'eventos';
        $this->relacionados = ['trabalho','categoriaEvento','estadoEventos'];
    }
}
