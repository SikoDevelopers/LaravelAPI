<?php

namespace App\Http\Controllers;

use App\Models\SupervisorExterno;
use Illuminate\Http\Request;

class SupervisorExternoController extends ModelController
{

    public function __construct() {
        $this->objecto = new   SupervisorExterno();
        $this->nomeObjecto = ' SupervisorExterno';
        $this->nomeObjectos = ' SupervisorExternos';
        $this->relacionados = ['areas','user'];
    }
}
