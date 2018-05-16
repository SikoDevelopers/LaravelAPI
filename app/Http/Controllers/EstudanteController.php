<?php

namespace App\Http\Controllers;

use App\Http\Controllers\classesAuxiliares\Auxiliar;
use App\Models\Estudante;

use App\Models\TipoUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EstudanteController extends ModelController {



    public function __construct() {
        $this->objecto = new Estudante();
        $this->nomeObjecto = 'estudante';
        $this->nomeObjectos = 'estudantes';
        $this->relacionados = ['trabalho', 'curso'];

    }


    /**
     * Criando conta para estudante
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function salvarTransacao(Request $request) {

        $this->validate($request, [
            'nome' => 'required|max:50',
            'apelido' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'cursos_id' => 'required'
        ]);


        $user = new User($request->all());
        $user->tipo_users_id = TipoUser::select('id')
                                ->where('designacao', '=','Estudante')
                                ->first()->id;

        $estudante = new Estudante($request->all());


        DB::beginTransaction();

        if(!$user->save())
            DB::rollBack();
        else{
            $estudante->users_id = $user->id;
            if(!$estudante->save())
                DB::rollBack();
            DB::commit();
        }

        return response()->json(['user' => $user, 'estudante' => $estudante], 200);
    }








    /**
     * busca o ultimo objecto a se adicionado
     * @return $object - ultimo objecto adicionado
     */
    public function buscarUltimo() {
        if (Estudante::count() > 0) {
            $estudante = Estudante::orderBy('created_at', 'desc')->first();
            return Auxiliar::retornarDados('estudante', $estudante, 200);
        }

        return Auxiliar::retornarErros('Nao foi encontrado nenhum estudante', 404);
    }

    /*------------------------------------------------- Metodos adicionais-------------------------------------------------------------------------*/

    /**
     * retorna todos os trabalhos de um estudante
     * @param $idEstudante
     * @return $trabahos
     */
    public function trabalhos($idEstudante){
        $estudante = Estudante::find($idEstudante);

        if($estudante) {
            return Auxiliar::retornarDados('trabalho', $estudante->trabalho, 200);
        }
        return Auxiliar::retornarErros('Estudante nao encontrado', 404);
    }

    /**
     * retorna todos os trabalhos de um estudante
     * @param $idEstudante
     * @return $trabahos
     */
    public function cursos($idEstudante){
        $estudante = Estudante::find($idEstudante);

        if($estudante) {
            return Auxiliar::retornarDados('curso', $estudante->curso, 200);
        }
        return Auxiliar::retornarErros('Estudante nao encontrado', 404);
    }


    public function getEstduanteByuser($id){
        $estudante =Estudante::where('users_id', $id)->get();

        return response()->json(['estudante'=>$estudante]);
    }







}
