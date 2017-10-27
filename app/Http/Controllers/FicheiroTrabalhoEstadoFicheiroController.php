<?php

namespace App\Http\Controllers;

use App\Models\EstadoFicheiro;
use App\Models\FicheirosTrabalho;
use App\Models\FicheiroTrabalho_EstadoFicheiro;
use Illuminate\Http\Request;

class FicheiroTrabalhoEstadoFicheiroController extends ModelController
{

    public function __construct() {
        $this->objecto = new   FicheiroTrabalho_EstadoFicheiro();
        $this->nomeObjecto = 'ficheiroTrabalho_EstadoFicheiro';
        $this->nomeObjectos = 'ficheiroTrabalho_EstadoFicheiro';
        $this->relacionados = ['categoriaFicheiro','trabalho','estadoFicheiros','ficheiroReprovado'];
    }


    public function getEstadoFicheiro($id){
        $ficheirTrabalho_id = FicheirosTrabalho::where('trabalhos_id',$id)->orderBy('created_at','desc')->first()->id;
        $estadoFT_id = FicheiroTrabalho_EstadoFicheiro::where([['ficheiros_trabalhos_id',$ficheirTrabalho_id],['is_actual',1],])->first();
        $estadoFicheiro = EstadoFicheiro::where('id',$estadoFT_id->estados_ficheiros_id)->first()->designacao;


        return response()->json(['ficheiroTraba'=>$ficheirTrabalho_id,'estadoFT'=>$estadoFT_id,'estado'=>$estadoFicheiro]);
    }
}
