<?php

namespace App\Http\Controllers;

use App\Models\AreasSupervisorExterno;
use App\Models\CategoriaFicheiro;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class TrabalhoController extends ModelController
{

    public function __construct() {
        $this->objecto = new Trabalho();
        $this->nomeObjecto = 'trabalho';
        $this->nomeObjectos = 'trabalhos';
        $this->relacionados = ['estudante','ficheirosTrabalhos','evento','docenteAreas'];


    }

    public function pesquisarSupervisorArea($supesrvisor_id,$areas_id,$tipo){

        if($tipo==1){
            $docenteArea = new DocenteArea();
            $docenteArea=DocenteArea::where(['areas_id'=>$areas_id], ['docentes_id'=>$supesrvisor_id])->first();


            return $docenteArea->id;
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

        if($request->tipoSup==1){
            $docenteAreaTra = new DocentesAreasTrabalho();
            $docenteAreaTra->trabalhos_id =$trabalhoPrincipal->id;
            $docenteAreaTra->funcoes_id = 1;
//            $docenteAreaTra= DocentesAreasTrabalho::where(['docente_areas_id'=>$this->pesquisarSupervisorArea($request->superviso,$request->area,$request->tipoSup)],['funcoes_id'=>1])->first();
            $docenteAreaTra->docente_areas_id = $this->pesquisarSupervisorArea($request->superviso,$request->area,$request->tipoSup);
            $docenteAreaTra->save();
        }elseif ($request->tipoSup==2){

            $trabalhoPrincipal->areas_supervisor_externos_id =$this->pesquisarSupervisorArea($request->supervisor,$request->area,$request->tipoSup)->id;
        }

        //Gravacao do protocolo
        $ficheiro_protcolo = new FicheirosTrabalho();
        Storage::putFileAs('public',$request->file('protocolo'),$request->user.'protocolo.pdf');
        $ficheiro_protcolo->data= $request->data;
        $ficheiro_protcolo->caminho=$request->user.'protocolo.pdf';
        $ficheiro_protcolo->categorias_ficheiros_id =1;
        $ficheiro_protcolo->trabalhos_id=$trabalhoPrincipal->id;
//        $ficheiro_protcolo->save();

//        $trabalhoPrincipal->save();
//        return response()->json(['trabalho'=>Trabalho::find($trabalhoPrincipal->id)]);
        return response()->json(['user'=>$request->user,'tema'=>$request->titulo,'descricao'=>$request->descricao,'supervisor'=>$request->supervisor,
            'tipo supervisor'=>$request->tipoSup,'area'=>$request->area,'data'=>$request->data,'timestamp'=>$request->timestamp
            ,'trabalho id'=>$trabalhoPrincipal->id
            ]);

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

//          if($trabalho->areaSupervisorExterno)
//            array_add($trabalho, 'supervisor_externo', SupervisorExterno::find($trabalho->areaSupervisorExterno->supervisor_externos_id));

            return response()->json(['trabalho' => $trabalho, 'docentes' => $docentes->all()], 200);
        }
        return response()->json(['trabalho' => $trabalho], 404);
    }



    public function getProtocolos(){

        $protocolos = CategoriaFicheiro::select('categorias_ficheiros.designacao','estudantes.nome','ficheiros_trabalhos.id', 'ficheiros_trabalhos.data', 'ficheiros_trabalhos.caminho', 'ficheiros_trabalhos.ficheiros_reprovados_id', 'trabalhos.titulo', 'trabalhos.descricao')
            ->where('categorias_ficheiros.id', '=', '2')
            ->join('ficheiros_trabalhos', 'categorias_ficheiros.id', '=','ficheiros_trabalhos.categorias_ficheiros_id')
            ->join('trabalhos', 'ficheiros_trabalhos.trabalhos_id', '=', 'trabalhos.id')
            ->join('estudantes', 'trabalhos.estudantes_id', '=', 'estudantes.id')
            ->orderByDesc('ficheiros_trabalhos.id')
            ->get();
        return response()->json(['protocolos'=>$protocolos]);
    }

    public function getTrabalhos(){

        $protocolos = CategoriaFicheiro::select('categorias_ficheiros.designacao','estudantes.nome','ficheiros_trabalhos.id', 'ficheiros_trabalhos.data', 'ficheiros_trabalhos.caminho', 'ficheiros_trabalhos.ficheiros_reprovados_id', 'trabalhos.titulo', 'trabalhos.descricao')
            ->where('categorias_ficheiros.id', '=', '1')
            ->join('ficheiros_trabalhos', 'categorias_ficheiros.id', '=','ficheiros_trabalhos.categorias_ficheiros_id')
            ->join('trabalhos', 'ficheiros_trabalhos.trabalhos_id', '=', 'trabalhos.id')
            ->join('estudantes', 'trabalhos.estudantes_id', '=', 'estudantes.id')
            ->orderByDesc('ficheiros_trabalhos.id')
            ->get();
        return response()->json(['trabalhos'=>$protocolos]);
    }


    public function getSupervisores() {
        $supervisores = Trabalho::select('');
    }



}
