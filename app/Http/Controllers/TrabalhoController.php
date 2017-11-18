<?php

namespace App\Http\Controllers;

use App\Models\AreasSupervisorExterno;
use App\Models\CategoriaFicheiro;
use App\Models\CoSupervisor;
use App\Models\DocenteArea;
use App\Models\DocentesAreasTrabalho;
use App\Models\EstadoFicheiro;
use App\Models\Estudante;
use App\Models\FicheirosTrabalho;
use App\Models\FicheiroTrabalho_EstadoFicheiro;
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
        $this->relacionados = ['estudante','ficheirosTrabalhos','evento','docenteAreas', 'coSupervisor'];
    }

    /**
     * @param $supesrvisor_id
     * @param $areas_id
     * @param $tipo
     * @return mixed
     */
    public function pesquisarSupervisorArea($supesrvisor_id,$areas_id,$tipo){
            $docenteArea = new DocenteArea();
            $docenteArea=DocenteArea::where(['areas_id'=>$areas_id], ['docentes_id'=>$supesrvisor_id])->first();
            return $docenteArea->id;
    }


    /**
     * @param Request $request - FormData que traz todos dados referentes ao trabalho
     * @return \Illuminate\Http\JsonResponse - Metodo para salvar um trabalho, onde consequentemente e gravado tambem
     * o protocolo (que vem junto com um ficheiro), e gravado tambem um docente area trabalho.
     */
    public function salvar(Request $request) {
        $trabalhoPrincipal = new Trabalho();
        $trabalhoPrincipal->titulo = $request->titulo;
        $trabalhoPrincipal->descricao = $request->descricao;
        $estadoFicheiro = new FicheiroTrabalho_EstadoFicheiro();

//return ['request'=>$request->control];
        //Co-Supervisor
        if($request->get('control')=='true'){

            $coSup = new CoSupervisor();
            $coSup->nome=$request->nomeCoSup." ".$request->apelidoCoSup;
            $coSup->grau_academico_id=$request->grauAcademico_id;
            $coSup->save();
//
        }else{

            $trabalhoPrincipal->co_supervisores_id= $request->coSupId;
        }


        //PegarEstudante
        $estudante = new Estudante();
        $estudante = Estudante::where('users_id',$request->user)->first();
        $trabalhoPrincipal->estudantes_id=$estudante->id;
        $trabalhoPrincipal->save();

       //Gravacao de Supervisor
            $docenteAreaTra = new DocentesAreasTrabalho();
            $docenteAreaTra->trabalhos_id =$trabalhoPrincipal->id;
            $docenteAreaTra->funcoes_id =  DB::table('funcoes')->where('designacao', 'Supervisor')->value('id');
            $docenteAreaTra->docente_areas_id = $this->pesquisarSupervisorArea($request->superviso,$request->area,$request->tipoSup);
            $docenteAreaTra->save();


        //Gravacao do protocolo
        $ficheiro_protocolo = new FicheirosTrabalho();
        Storage::putFileAs('public',$request->file('protocolo'),$request->timestamp.'protocolo');
        $ficheiro_protocolo->data= date("Y-m-d") ;
        $ficheiro_protocolo->caminho=$request->timestamp.'protocolo';
        $ficheiro_protocolo->categorias_ficheiros_id =DB::table('categorias_ficheiros')->where('designacao', 'Protocolo')->value('id');
        $ficheiro_protocolo->trabalhos_id=$trabalhoPrincipal->id;
        $ficheiro_protocolo->save();
        $estadoFicheiro->ficheiros_trabalhos_id =$ficheiro_protocolo->id;
        $estadoFicheiro->estados_ficheiros_id =DB::table('estados_ficheiros')->where('designacao', 'Protocolo Submetido')->value('id');
        $estadoFicheiro->is_actual =1;
        $estadoFicheiro->save();


//        return response()->json(['trabalho'=>Trabalho::find($trabalhoPrincipal->id)]);
        return response()->json(['request'=>$request->all()]);

    }

    /**Metodo para gravar protcolo de um trabalho
     * @param Request $request
     */
    public function salvarProtocolo(Request $request){

        $trabalhoPrincipal = Trabalho::where('estudantes_id',$request->estudante_id)->with('ficheirosTrabalhos')->first();

        $estadoFicheiro = new FicheiroTrabalho_EstadoFicheiro();

        //Gravacao do protocolo
        $ficheiro_trabalho = new FicheirosTrabalho();
        Storage::putFileAs('public',$request->file('trabalho'),$request->timestamp.'trabalho');
        $ficheiro_trabalho->data= date("Y-m-d") ;
        $ficheiro_trabalho->caminho=$request->timestamp.'trabalho';
        $ficheiro_trabalho->categorias_ficheiros_id =DB::table('categorias_ficheiros')->where('designacao', 'Protocolo')->value('id');
        $ficheiro_trabalho->trabalhos_id=$trabalhoPrincipal->id;
        $ficheiro_trabalho->save();
        $estadoFicheiro->ficheiros_trabalhos_id =$ficheiro_trabalho->id;
        $estadoFicheiro->estados_ficheiros_id =DB::table('estados_ficheiros')->where('designacao', 'Pendente')->value('id');
        $estadoFicheiro->is_actual =1;
        $estadoFicheiro->save();
        return response()->json(['trabalho'=>Trabalho::find($trabalhoPrincipal->id)]);
    }

    /**
     * Metoto para gravar o trabalho final
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function salvarFinal(Request $request){
        if ($request->tipoFile=='protocolo'){

            return $this->salvarProtocolo($request);

        }
        if ($request->tipoFile=='relatorio'){
            return $this->guardarTrabalhoVerssao($request);
        }


        return ['error'=>'error'];

    }

    public function guardarTrabalhoVerssao(Request $request){

        $trabalhoPrincipal = Trabalho::where('estudantes_id',$request->estudante_id)->with('ficheirosTrabalhos')->first();

        $estadoFicheiro = new FicheiroTrabalho_EstadoFicheiro();

        //Gravacao do protocolo
        $ficheiro_trabalho = new FicheirosTrabalho();
        Storage::putFileAs('public',$request->file('trabalho'),$request->timestamp.'trabalho');
        $ficheiro_trabalho->data= date("Y-m-d") ;
        $ficheiro_trabalho->caminho=$request->timestamp.'trabalho';
        $ficheiro_trabalho->categorias_ficheiros_id =DB::table('categorias_ficheiros')->where('designacao', 'Trabalho')->value('id');
        $ficheiro_trabalho->trabalhos_id=$trabalhoPrincipal->id;
        $ficheiro_trabalho->save();
        $estadoFicheiro->ficheiros_trabalhos_id =$ficheiro_trabalho->id;
        $estadoFicheiro->estados_ficheiros_id =DB::table('estados_ficheiros')->where('designacao', 'Pendente')->value('id');
        $estadoFicheiro->is_actual =1;
        $estadoFicheiro->save();
        return response()->json(['trabalho'=>Trabalho::find($trabalhoPrincipal->id)]);
    }



    /**
     * Metodo para verificar se um estudante tem trabalho
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function hasJob($id){
        $estudante_id = DB::table('estudantes')->where('users_id', $id)->value('id');
        $job = Trabalho::where('estudantes_id',$estudante_id)->first();

        if ($job!=null)
            return response()->json(['job'=>$job,'resultado'=>true,'estudante'=>$estudante_id]);
        else
            return response()->json(['job'=>$job,'resultado'=>false,'estudante'=>$estudante_id]);
        return response()->json(['job'=>$job,'resultado'=>'error','estudante'=>$estudante_id]);
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

        $tipoFicheiro = CategoriaFicheiro::select('id')->where('designacao', '=', 'Protocolo')->first()['id'];

        $protocolos = CategoriaFicheiro::select('categorias_ficheiros.designacao', 'trabalhos.id as trabalho_id', 'estudantes.nome','ficheiros_trabalhos.id', 'ficheiros_trabalhos.created_at', 'ficheiros_trabalhos.caminho', 'ficheiros_trabalhos.ficheiros_reprovados_id', 'trabalhos.titulo', 'trabalhos.descricao', 'estados_ficheiros.designacao as estado_ficheiro', 'estados_ficheiros.id as ficheiro_estado_id', 'ficheiros_trabalhos.avaliacoes_id')
            ->where('categorias_ficheiros.id', '=', $tipoFicheiro)
            ->join('ficheiros_trabalhos', 'categorias_ficheiros.id', '=','ficheiros_trabalhos.categorias_ficheiros_id')
            ->leftJoin('avaliacoes', 'avaliacoes.id', '=','ficheiros_trabalhos.avaliacoes_id')
            ->join('ficheiros_trabalhos_estados_ficheiros', 'ficheiros_trabalhos.id', '=','ficheiros_trabalhos_estados_ficheiros.ficheiros_trabalhos_id')
            ->join('estados_ficheiros','ficheiros_trabalhos_estados_ficheiros.estados_ficheiros_id', '=', 'estados_ficheiros.id')
            ->join('trabalhos', 'ficheiros_trabalhos.trabalhos_id', '=', 'trabalhos.id')
            ->join('estudantes', 'trabalhos.estudantes_id', '=', 'estudantes.id')
            ->orderByDesc('ficheiros_trabalhos.id')
            ->orderByDesc('estados_ficheiros.id')
            ->latest('estados_ficheiros.id')
            ->get();
//        return FicheirosTrabalho::find(15)->estadoFicheiros->last();

        return response()->json(['protocolos'=>$protocolos]);
    }

    public function getTrabalhos(){
        $tipoFicheiro = CategoriaFicheiro::select('id')->where('designacao', '=', 'Trabalho')->first()['id'];

        $protocolos = CategoriaFicheiro::select('trabalhos.id','categorias_ficheiros.designacao','estudantes.nome','ficheiros_trabalhos.id', 'ficheiros_trabalhos.data', 'ficheiros_trabalhos.caminho', 'ficheiros_trabalhos.ficheiros_reprovados_id', 'trabalhos.titulo', 'trabalhos.descricao')
            ->where('categorias_ficheiros.id', '=', $tipoFicheiro)
            ->join('ficheiros_trabalhos', 'categorias_ficheiros.id', '=','ficheiros_trabalhos.categorias_ficheiros_id')
            ->join('trabalhos', 'ficheiros_trabalhos.trabalhos_id', '=', 'trabalhos.id')
            ->join('estudantes', 'trabalhos.estudantes_id', '=', 'estudantes.id')
            ->orderByDesc('ficheiros_trabalhos.id')
            ->get();
        return response()->json(['trabalhos'=>$protocolos]);
    }


    /**
     * Retorna a areas do supervisor num determinado trabalho
     * @param $id
     * @return mixed
     */
    public function getAreaSupervisorNoTrabalho($id){
        $docenteAreas = Trabalho::find($id)->docenteAreas;

        foreach($docenteAreas as $docenteArea1){
            if(Funcao::find($docenteArea1->pivot->funcoes_id)->designacao == 'Supervisor')
                return $docenteArea1->areas_id;
        }



        return null;
    }

    
    /**

     *cria um Docente_areastrabalho (Participantes envolvidos em um trabalho)
     * @param Request $request
     * @return mixed
     */
    public function adicionarParticipantes(Request $request){
        $trabalho = $request->input('trabalho');
        $participantes = $request->input('participantes');

        $areaSupervisor = $this->getAreaSupervisorNoTrabalho($trabalho['id']);

//        if($areaSupervisor == null)


            DB::beginTransaction();

            foreach ($participantes as $participante) {
                if (!$docente_area = DocenteArea::create(['areas_id' => $areaSupervisor, 'docentes_id' => $participante['id']]))
                    DB::rollBack();
                else {
                    if (!$docente_area_trabalho = DocentesAreasTrabalho::create(['docente_areas_id' => $docente_area['id'], 'trabalhos_id' => $trabalho['id'], 'funcoes_id' => $participante['funcao']['id']]))
                        DB::rollBack();
                    else {
                        DB::commit();
                    }
                }
            }
        return ['docente_area' => $docente_area, 'particpante' => $docente_area_trabalho];
//        return Auxiliar::retornarErros('Nao foi possivel criar participantes', '404');
    }



     /** metodo para retornar trabalho de estudante especifico, indicando o estudante_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTrabalhoEstudante($id){
        $trabalho =Trabalho::where('estudantes_id',$id)->with('ficheirosTrabalhos')->first();

        return response()->json(['trabalho'=>$trabalho]);
    }


    /**
     * Metodo usado para ir buscar um trablho dado o id
     * @param $id - id do trabalho
     * @return \Illuminate\Http\JsonResponse - json com os dados do trabalho
     */
    public function getTrabalho($id){
        $trabalho = Trabalho::where('id','=',$id)
                    ->with('estudante')
                    ->first();
        return response()->json(['trabalho'=>$trabalho]);

    }

}
