<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends ModelController
{


    public function __construct() {
        $this->objecto = new Area();
        $this->nomeObjecto = 'area';
        $this->nomeObjectos = 'areas';
        $this->relacionados = ['docentes','supervisorExternos', 'temas'];
    }

}
