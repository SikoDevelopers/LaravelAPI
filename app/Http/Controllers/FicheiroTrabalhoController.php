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
        $this->relacionados = ['categoriaFicheiro','trabalho','estadoFicheiros','ficheiroReprovado', 'avaliacao'];
    }

    /**
     * Metodo para pegar todos ficheiros de trabalho (caminhos)
     * @param $id
     */
public function getFicheiros($id){
          $ficheiros = FicheirosTrabalho::where('trabalhos_id',$id)->with('estadoFicheiros','categoriaFicheiro')->get();

     return response()->json(['ficheiros'=>$ficheiros]);
    }

    /**
     * Metodo para fazer display de ficheiro de trabalho
     * @param Request $request
     */
    public function displayFile($caminho){
        $pathToFile = Storage::url($caminho);
//        return response()->file($pathToFile);
        return response()->json(['resultado'=>'teste']);

    }

public function display($caminho){
    $pathToFile = Storage::path($caminho);
    $headers = ['Content-Type: application/pdf'];

//    return response()->file($pathToFile,$headers);
    return response()->file(storage_path('app/public/'.$caminho));
//        return response()->download(storage_path('app/public/'.$caminho),'jjjjjj.pdf', $headers);
//    return Storage::url($caminho);
}


public function baixar($caminho){
    $pathToFile = Storage::path($caminho);
    $headers = ['Content-Type: application/pdf'];

    return response()->download(storage_path('app/public/'.$caminho));
}


    /**
     * retorna a avaliacao de um dado ficheiro
     * @param $id - o ficheiro dado
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function getAvaliacao($id){
        return response()->json(['avaliacao' => FicheirosTrabalho::find($id)->avaliacao]);
    }



}
