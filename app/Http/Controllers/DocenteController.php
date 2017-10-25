<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\DocenteArea;
use App\Models\DocentesAreasTrabalho;
use App\Models\Estudante;
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
            return response()->json(['docente'=>$docente]);
    }

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
//                echo $docente_area;

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
//
//        echo $trabalhos_que_supervisona;

        $trabalho_que_supervisona = null;
        $estudantes_que_supervisiona =  collect();
        if($trabalhos_que_supervisona){

            foreach ($trabalhos_que_supervisona as $trabalho_que_supervisona){
                $est = Trabalho::select('apelido','nome','trabalhos.titulo','trabalhos.created_at','trabalhos.is_aprovado')
                    ->where('trabalhos.id',$trabalho_que_supervisona->trabalhos_id)
                    ->join('estudantes','trabalhos.estudantes_id','=','estudantes.id')
                    ->get();

                if($est){
//                    array_add($estudantes_que_supervisiona, 'estudantes', $est);
                    $estudantes_que_supervisiona->push($est);
                }
            }

        }

//        echo $estudantes_que_supervisiona;

        return response()->json(['estudantes_do_docente'=>$estudantes_que_supervisiona]);

    }



}
