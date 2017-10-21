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
use App\Models\Funcao;
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

    public function pesquisarSupervisorArea($supervisor_id,$areas_id,$tipo){

        if($tipo==1){
            $docenteArea = new DocenteArea();
            $docenteArea=DocenteArea::where(['areas_id'=>$areas_id],
                ['docentes_id'=>$supervisor_id],['funcao_id'=>1])->first();

            $sup=DocentesAreasTrabalho::where(['docente_areas_id'=>$docenteArea->id],['funcoes_id'=>1])->first();
            return $sup;
        }elseif ($tipo==2){
            $supExtArea = new  AreasSupervisorExterno();
            $supExtArea = AreasSupervisorExterno::where(['areas_id'=>$areas_id],
                ['supervisor_externos_id'=>$supervisor_id])->first();

            return $supExtArea;
        }
    }

    public function salvar(Request $objecto) {

//
//        $trabalhoPrincipal = new Trabalho();
//        //PegarEstudante
//        $estudante = new Estudante();
//
//        $estudante = Estudante::where('users_id',$objecto->user)->first();
//        $trabalhoPrincipal->estudantes_id=$estudante->id;
//        $trabalhoPrincipal->titulo=$objecto->titulo;
//        $trabalhoPrincipal->descricao=$objecto->descricao;
//        $trabalhoPrincipal->save();
//
//
//        //Gravacao de Supervisor
//        if($objecto->tipoSup==1){
//            $docenteAreaTra = new DocentesAreasTrabalho();
//            $docenteAreaTra->trabalhos_id =$trabalhoPrincipal->id;
//            $docenteAreaTra->funcoes_id = 1;
//            $docenteAreaTra->docente_areas_id = $this->pesquisarSupervisorArea($objecto->supervisor_id,$objecto->areas_id,$objecto->tipoSup)->id;
//            $docenteAreaTra->save();
//        }elseif ($objecto->tipoSup==2){
//
//            $trabalhoPrincipal->areas_supervisor_externos_id =$this->pesquisarSupervisorArea($objecto->supervisor_id,$objecto->areas_id,$objecto->tipoSup)->id;
//        }
//
//
////        //Gravacao do protocolo
//        $ficheiro_protcolo = new FicheirosTrabalho();
//        Storage::putFileAs('public',$objecto->file,'protocolo.pdf'.$objecto->user);
//        $ficheiro_protcolo->data= $objecto->data;
//        $ficheiro_protcolo->caminho='protocolo.pdf'.$objecto->user;
//        $ficheiro_protcolo->categorias_ficheiros_id =1;
//        $ficheiro_protcolo->trabalhos_id=$trabalhoPrincipal->id;
//        $ficheiro_protcolo->save();
//
//
//
//////            $sup = $trabalhoPrincipal->supervisor();
//
//        $trabalhoPrincipal->save();
        return response()->json(['trabalho'=>$objecto->titulo]);


    }



    /**
     * @param $idTrabalho
     * @return \Illuminate\Http\JsonResponse
     * Metodo que dado um trabalho, retorna todos os docentes envolvidos nesse trabalho, com as
     * suas respectivas funcoes e responsabilidades nesse trabalho
     */
    public function getParticipantesTrabalho($idTrabalho) {
        $docentes = collect();
        if ($trabalho = Trabalho::find($idTrabalho)) {

          foreach ($trabalho->docenteAreas as $docente_area){
              $docentes->push(array_add(
                              array_add(Docente::find($docente_area->docentes_id),
                                  'area_participacao', Area::find($docente_area->areas_id)),
                              'funcao', Funcao::find($docente_area->pivot->funcoes_id)));
          }

          array_add($trabalho, 'supervisor_externo', SupervisorExterno::find($trabalho->areaSupervisorExterno->supervisor_externos_id));

            return response()->json(['trabalho' => $trabalho, 'docentes' => $docentes->all()], 200);
        }
        return response()->json(['trabalho' => $trabalho], 404);
    }


}
