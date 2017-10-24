<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use Illuminate\Http\Request;

class TemaController extends ModelController
{

    public function __construct() {
        $this->objecto = new   Tema();
        $this->nomeObjecto = 'tema';
        $this->nomeObjectos = 'tema';
        $this->relacionados = ['docente','area'];
    }

    public function getTemasDoDocente(Request $request){
        $temas = Tema::where('docentes_id',$request->id)->orderBy('id','desc')->get();
        return response()->json(['temas_docente'=>$temas]);
    }
}
