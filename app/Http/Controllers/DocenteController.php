<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\DocentesAreasTrabalho;
use App\Models\DocenteArea;
use App\Models\Estudante;
use App\Models\FicheirosTrabalho;
use App\Models\FicheiroTrabalho_EstadoFicheiro;
use App\Models\TipoUser;
use App\Models\Trabalho;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DocenteController extends ModelController
{


    public function __construct() {
        $this->objecto = new Docente();
        $this->nomeObjecto = 'docente';
        $this->nomeObjectos = 'docentes';
        $this->relacionados = ['areas', 'temas'];
    }


    /**
     * Criando conta para docente
     * @param Request $objectos
     * @return \Illuminate\Http\JsonResponse
     */
    public function salvarTransacao(Request $objectos) {

        $this->validate($objectos, [
            'nome' => 'required|max:50',
            'apelido' => 'required',
            'sessao' => 'nullable',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'grau_academico_id' => 'required'
        ]);

        $user = new User($objectos->all());
        $user->tipo_users_id = TipoUser::select('id')
            ->where('designacao', '=','Docente')
            ->first()->id;

        $docente = new Docente($objectos->all());


        DB::beginTransaction();

        if(!$user->save())
            DB::rollBack();
        else{
            $docente->users_id = $user->id;
            if(!$docente->save())
                DB::rollBack();
            DB::commit();
        }

        return response()->json(['user' => $user, 'docente' => $docente], 200);
    }


    public function getDocenteByUserId(Request $request){
        $docente = Docente::where('users_id',$request->id)->first();
            return response()->json(['dcoente'=>$docente]);
    }


    /**
     * @param $id
     * Retorna os supervisandos de um determinado docente
     */
    public function getSupervisandos($id){
//        if($docente = Docente::find($id)) {
//            $docentesAreasTrabalhos = DocentesAreasTrabalho::where('');
//        }
//

//        $docente = Docente::select('docentes.nome')->join('areas', 'docentes.id', '=', 'docente_areas.docentes_id');

        $docente = DocentesAreasTrabalho::where('docentes.id', '=', '2')
            ->join('docente_areas', 'docente_areas_trabalhos.docente_areas_id', '=', 'docente_areas.id')
            ->join('docentes', 'docente_areas.docentes_id', '=', 'docentes.id')
            ->join('funcoes', 'docente_areas_trabalhos.funcoes_id', '=','funcoes.id')->count();

        return response()->json(['supervisandos'=>$docente]);
    }

    /**
     * Metodo usado para ir buscar dados dos estudantes que um determinado docente supervisiona!
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSupervisionandos(Request $request){
        /**
         * Indo buscar todas areas do docente e armazenamos na var $docente_areas.
         */
        $docente_areas = DocenteArea::select('id')->where('docentes_id',$request->id)->get();


        /**
         * Indo buscar todos trabalhos que o docente supervisona
         */
        $docente_area = null;
        $trabalhos_que_supervisona = collect();
        if($docente_areas){

            foreach ($docente_areas as $docente_area){

                $trab = DocentesAreasTrabalho::select('trabalhos_id')
                    ->where('funcoes_id','=',1,'and')
                    ->where('docente_areas_id','=',$docente_area->id,'and')->first();

                if($trab){
                    $trabalhos_que_supervisona->push(
                        $trab
                    );
                }
                $trab = null;

            }
        }

        $trabalho_que_supervisona = null;
        $estudantes_que_supervisiona =  collect();
        if($trabalhos_que_supervisona){

            foreach ($trabalhos_que_supervisona as $trabalho_que_supervisona){
                $est = Trabalho::select('apelido','nome','trabalhos.titulo','trabalhos.created_at','trabalhos.is_aprovado')
                    ->where('trabalhos.id',$trabalho_que_supervisona->trabalhos_id)
                    ->join('estudantes','trabalhos.estudantes_id','=','estudantes.id')
                    ->get();

                if($est){

                    $estudantes_que_supervisiona->push($est);
                }
            }

        }

        return response()->json(['estudantes_do_docente'=>$estudantes_que_supervisiona]);

    }

    /**
     * Metodo usando para buscar dados de estudantes que o docente ope
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOponencias(Request $request){
        /**
         * Indo buscar todas areas do docente e armazenamos na var $docente_areas.
         */
        $docente_areas = DocenteArea::select('id')->where('docentes_id',$request->id)->get();




        /**
         * Indo buscar todos trabalhos que o docente opoe
         */
        $docente_area = null;
        $trabalhos_que_supervisona = collect();
        if($docente_areas){

            foreach ($docente_areas as $docente_area){

                $trab = DocentesAreasTrabalho::select('trabalhos_id')
                    ->where('funcoes_id','=',4,'and')
                    ->where('docente_areas_id','=',$docente_area->id,'and')->first();

                if($trab){
                    $trabalhos_que_supervisona->push(
                        $trab
                    );
                }
                $trab = null;

            }
        }

        $trabalho_que_supervisona = null;
        $estudantes_que_supervisiona =  collect();
        if($trabalhos_que_supervisona){

            foreach ($trabalhos_que_supervisona as $trabalho_que_supervisona){
                $est = Trabalho::select('apelido','nome','trabalhos.titulo','trabalhos.created_at','trabalhos.is_aprovado')
                    ->where('trabalhos.id',$trabalho_que_supervisona->trabalhos_id)
                    ->join('estudantes','trabalhos.estudantes_id','=','estudantes.id')
                    ->get();

                if($est){
                    $estudantes_que_supervisiona->push($est);
                }
            }

        }

        return response()->json(['oponencias_do_docente'=>$estudantes_que_supervisiona]);

    }

    public function getSolicitacoesSupervisao(Request $request){
        /**
         * Indo buscar todas areas do docente e armazenamos na var $docente_areas.
         */
        $docente_areas = DocenteArea::select('id')->where('docentes_id',$request->id)->get();




        /**
         * Indo buscar todos trabalhos que o docente supervisiona
         */
        $docente_area = null;
        $trabalhos_que_supervisona = collect();
        if($docente_areas){

            foreach ($docente_areas as $docente_area){

                $trab = DocentesAreasTrabalho::select('trabalhos_id')
                    ->where('funcoes_id','=',3,'and')
                    ->where('docente_areas_id','=',$docente_area->id,'and')
                    ->first();

                if($trab){
                    $trabalhos_que_supervisona->push(
                        $trab
                    );
                }
                $trab = null;

            }
        }


        $ficheiros_trabalhos = collect();
        $trabalho_que_supervisona = null;
        if($trabalhos_que_supervisona){
            foreach($trabalhos_que_supervisona as $trabalho_que_supervisona){
                $file = FicheirosTrabalho::select('id')
                    ->where('categorias_ficheiros_id','=',2)
                    ->where('trabalhos_id','=',$trabalho_que_supervisona->trabalhos_id)
                    ->first();
                if($file){
                    $ficheiros_trabalhos->push($file);
                }


            }
        }
        echo $ficheiros_trabalhos;
        return;
        $ficheiros_trabalhos_estados = collect();
        $ficheiros_trabalho = null;
        if($ficheiros_trabalhos){
            foreach ($ficheiros_trabalhos as $ficheiros_trabalho){
                $trbalho = FicheiroTrabalho_EstadoFicheiro::where('is_actual','=',1)
                    ->where('estados_ficheiros_id','=',3)
                    ->where('ficheiros_trabalhos_id','=',$ficheiros_trabalho[0]->id)
                    ->first();

                if($trbalho){
                    $ficheiros_trabalhos_estados->push($trbalho);
                }
            }
        }

        echo $ficheiros_trabalhos_estados;

    }
}
