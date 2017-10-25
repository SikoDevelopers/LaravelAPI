<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\DocenteArea;
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
        $docente_areas = retornarAreasDoDocente($request);
        echo $docente_areas;
//        $supervisionandos = Estudante::select('apelido','nome','trabalho.titulo','created_at','is_aprovado')
//            ->where('');
    }

    public function retornarAreasDoDocente(Request $request){
        return DocenteArea::select('id','areas_id')->where('docente_id',$request->id)->get();

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
