<?php

namespace App\Http\Controllers;

use App\Models\FicheirosTrabalho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FicheiroTrabalhoController extends ModelController
{
    public function __construct() {
        $this->objecto = new  FicheirosTrabalho();
        $this->nomeObjecto = 'ficheiroTrabalho';
        $this->nomeObjectos = 'ficheiroTrabalhos';
        $this->relacionados = ['categoriaFicheiro','trabalho','estadoFicheiros','ficheiroReprovado'];
    }


public function getFicheiros($id){
          $ficheiros = DB::table('ficheiros_trabalhos')->where('trabalhos_id',id);
          $allFiles=[];
        foreach ($ficheiros as $index => $ficheiro){

            $allFiles[$index] = Storage::url($ficheiro['caminho']);
    }
}
}
