<?php

namespace App\Http\Controllers;
use App\Models\AreasSupervisorExterno;
use App\Models\DocenteArea;
use App\Models\DocentesAreasTrabalho;
use App\Models\Estudante;
use App\Models\FicheirosTrabalho;
use App\Models\SupervisorExterno;
use App\Http\Controllers\classesAuxiliares\Auxiliar;
use App\Models\Area;
use App\Models\Docente;
use App\Models\Trabalho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrabalhoController extends ModelController
{

    public function __construct() {
        $this->objecto = new   Trabalho();
        $this->nomeObjecto = 'trabalho';
        $this->nomeObjectos = 'trabalhos';
        $this->relacionados = ['estudante','ficheirosTrabalhos','evento','docenteAreas','areaSupervisorExterno'];

    }

    public function pesquisarSupervisorArea($supesrvisor_id,$areas_id,$tipo){

        if($tipo==1){
            $docenteArea = new DocenteArea();
            $docenteArea=DocenteArea::where(['areas_id'=>$areas_id],
                ['docentes_id'=>$supesrvisor_id],['funcao_id'=>1])->first();

            $sup=DocentesAreasTrabalho::where(['docente_areas_id'=>$docenteArea->id],['funcoes_id'=>1])->first();
            return $sup;
        }elseif ($tipo==2){
            $supExtArea = new  AreasSupervisorExterno();
            $supExtArea = AreasSupervisorExterno::where(['areas_id'=>$areas_id],
                ['supervisor_externos_id'=>$supesrvisor_id])->first();

            return $supExtArea;
        }
    }

    public function salvar(Request $request) {

        $trabalhoPrincipal = new Trabalho();
        $trabalhoPrincipal->titulo = $request->titulo;
        $trabalhoPrincipal->descricao = $request->descricao;

       //PegarEstudante
        $estudante = new Estudante();

        $estudante = Estudante::where('users_id',$request->user)->first();
        $trabalhoPrincipal->estudantes_id=$estudante->id;
        $trabalhoPrincipal->save();
//
//
//        //Gravacao de Supervisor
//        if($request->tipoSup==1){
//            $docenteAreaTra = new DocentesAreasTrabalho();
//            $docenteAreaTra->trabalhos_id =$trabalhoPrincipal->id;
//            $docenteAreaTra->funcoes_id = 1;
//            $docenteAreaTra->docente_areas_id = $this->pesquisarSupervisorArea($request->supervisor_id,$request->areas_id,$request->tipoSup)->id;
//            $docenteAreaTra->save();
//        }elseif ($request->tipoSup==2){
//
//            $trabalhoPrincipal->areas_supervisor_externos_id =$this->pesquisarSupervisorArea($request->supervisor_id,$request->areas_id,$request->tipoSup)->id;
//        }
//
//
////        //Gravacao do protocolo
//        $ficheiro_protcolo = new FicheirosTrabalho();
//        Storage::putFileAs('public',$request->file('file'),'protocolo.pdf'.$request->user);
//        $ficheiro_protcolo->data= $request->data;
//        $ficheiro_protcolo->caminho='protocolo.pdf'.$request->user;
//        $ficheiro_protcolo->categorias_ficheiros_id =1;
//        $ficheiro_protcolo->trabalhos_id=$trabalhoPrincipal->id;
//        $ficheiro_protcolo->save();
//
//        $trabalhoPrincipal->save();
//        return response()->json(['trabalho'=>Trabalho::find($trabalhoPrincipal->id)]);
        return response()->json(['user'=>$request->user,'tema'=>$request->titulo,'descricao'=>$request->descricao,'supervisor'=>$request->supervisor,
            'tipo supervisor'=>$request->tipoSup,'area'=>$request->area,'data'=>$request->data,'timestamp'=>$request->timestamp

            ]);

    }



    public function getParticipantesTrabalho($idTrabalho) {

        if ($trabalho = Trabalho::find($idTrabalho)->with('estudante', 'docenteAreas')) {
//            $docentesAreas =  $trabalho->docenteAreas;

//            $area = $trabalho->docenteAreas;
//            $estudante = $trabalho->estudante;

            return response()->json(['trabalho' => $trabalho], 200);
        }
        return response()->json(['trabalho' => $trabalho], 404);
    }


}
