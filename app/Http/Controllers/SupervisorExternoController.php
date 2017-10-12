<?php

namespace App\Http\Controllers;

use App\Models\SupervisorExterno;
use Illuminate\Http\Request;

class SupervisorExternoController extends ModelController
{

    public function __construct() {
        $this->objecto = new   SupervisorExterno();
        $this->nomeObjecto = 'supervisorExterno';
        $this->nomeObjectos = 'supervisorExternos';
        $this->relacionados = ['areas','user'];
    }
}
