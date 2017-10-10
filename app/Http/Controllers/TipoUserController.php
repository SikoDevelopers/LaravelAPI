<?php

namespace App\Http\Controllers;

use App\Models\TipoUser;
use Illuminate\Http\Request;

class TipoUserController extends ModelController
{

    public function __construct() {
        $this->objecto = new   TipoUser();
        $this->nomeObjecto = ' TipoUser';
        $this->nomeObjectos = ' TipoUsers';
        $this->relacionados = ['users'];
    }
}
