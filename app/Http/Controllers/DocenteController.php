<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\DocentesAreasTrabalho;
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


}
