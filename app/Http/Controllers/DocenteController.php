<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\DocenteArea;
use App\Models\DocentesAreasTrabalho;
use App\Models\Estudante;
use App\Models\TipoUser;
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

        $trabalhos_que_supervisona = collect();
        $docente_area = 0;

        if($docente_areas){
            foreach ($docente_areas as $docente_area){
                echo $docente_area;

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

       echo $trabalhos_que_supervisona;
//        $supervisionandos = Estudante::select('apelido','nome','trabalho.titulo','created_at','is_aprovado')
//            ->where('');
    }

    public function retornarAreasDoDocente(Request $request){
      //  return

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

}
