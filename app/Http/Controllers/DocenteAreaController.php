<?php

namespace App\Http\Controllers;

use App\Models\DocenteArea;
use Illuminate\Http\Request;

class DocenteAreaController extends ModelController
{

    public function __construct() {
        $this->objecto = new   DocenteArea();
        $this->nomeObjecto = 'docenteArea';
        $this->nomeObjectos = 'docenteAreas';
        $this->relacionados = ['trabalhos,docentes'];
    }


}
