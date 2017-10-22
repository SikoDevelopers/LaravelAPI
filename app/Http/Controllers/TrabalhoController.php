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
        $this->objecto = new Trabalho();
        $this->nomeObjecto = 'trabalho';
        $this->nomeObjectos = 'trabalhos';
        $this->relacionados = ['estudante','ficheirosTrabalhos','evento','docenteAreas','areaSupervisorExterno'];


    }

    public function pesquisarSupervisorArea($supesrvisor_id,$areas_id,$tipo){


            $docenteArea = new DocenteArea();
            $docenteArea=DocenteArea::where(['areas_id'=>$areas_id], ['docentes_id'=>$supesrvisor_id])->first();
            return $docenteArea->id;

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

//        //Gravacao de Supervisor

            $docenteAreaTra = new DocentesAreasTrabalho();
            $docenteAreaTra->trabalhos_id =$trabalhoPrincipal->id;
            $docenteAreaTra->funcoes_id = 1;
            $docenteAreaTra->docente_areas_id = $this->pesquisarSupervisorArea($request->superviso,$request->area,$request->tipoSup);
            $docenteAreaTra->save();


        //Gravacao do protocolo
        $ficheiro_protocolo = new FicheirosTrabalho();
        Storage::putFileAs('public',$request->file('protocolo'),$request->user.$request->created_at.'protocolo.pdf');
        $ficheiro_protocolo->data= "2006-08-15";
        $ficheiro_protocolo->caminho=$request->user.$request->created_at.'protocolo.pdf';
        $ficheiro_protocolo->categorias_ficheiros_id =1;
        $ficheiro_protocolo->trabalhos_id=$trabalhoPrincipal->id;
        $ficheiro_protocolo->save();


        return response()->json(['trabalho'=>Trabalho::find($trabalhoPrincipal->id)]);
//        return response()->json(['user'=>$request->user,'tema'=>$request->titulo,'descricao'=>$request->descricao,'supervisor'=>$request->supervisor,
//            'tipo supervisor'=>$request->tipoSup,'area'=>$request->area,'data'=>$request->data,'timestamp'=>$request->timestamp
//            ,'trabalho id'=>$trabalhoPrincipal->id
//            ]);

    }



    /**
     * @param $idTrabalho
     * @return \Illuminate\Http\JsonResponse - toda informacoe relevante sobre um trabalho
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

          if($trabalho->areaSupervisorExterno)
            array_add($trabalho, 'supervisor_externo', SupervisorExterno::find($trabalho->areaSupervisorExterno->supervisor_externos_id));

            return response()->json(['trabalho' => $trabalho, 'docentes' => $docentes->all()], 200);
        }
        return response()->json(['trabalho' => $trabalho], 404);
    }


}
