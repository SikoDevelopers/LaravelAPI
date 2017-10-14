<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends ModelController
{

    public function __construct() {
        $this->objecto = new  Funcionario();
        $this->nomeObjecto = 'funcionario';
        $this->nomeObjectos = 'funcionarios';
        $this->relacionados = ['user'];
    }
}
