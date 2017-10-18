<?php

namespace App\Http\Controllers;

use App\Models\ProcessoSubmissao;
use Illuminate\Http\Request;

class ProcessoSubmissaoController extends ModelController
{
    public function __construct() {
        $this->objecto = new ProcessoSubmissao();
        $this->nomeObjecto = 'prcesso_submissao';
        $this->nomeObjectos = 'prcesso_submissao';
        $this->relacionados = [];
    }

}
