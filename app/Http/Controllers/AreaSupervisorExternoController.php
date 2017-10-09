<?php

namespace App\Http\Controllers;

use App\Models\AreasSupervisorExterno;
use Illuminate\Http\Request;

class AreaSupervisorExternoController extends ModelController
{


    public function __construct() {
        $this->objecto = new AreasSupervisorExterno();
        $this->nomeObjecto = 'AreaSupervisorExterno';
        $this->nomeObjectos = 'AreaSupervisorExternos';
        $this->relacionados = ['trabalhos'];
    }
}
