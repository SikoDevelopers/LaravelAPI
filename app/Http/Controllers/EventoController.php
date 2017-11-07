<?php

namespace App\Http\Controllers;

use App\Http\Controllers\classesAuxiliares\Auxiliar;
use App\Models\CategoriaEvento;
use App\Models\Evento;
use App\Models\Trabalho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventoController extends ModelController
{
    public function __construct() {
        $this->objecto = new  Evento();
        $this->nomeObjecto = 'evento';
        $this->nomeObjectos = 'eventos';
        $this->relacionados = ['trabalho','categoriaEvento','estadoEventos'];
    }


    public function salvarTransacao(Request $objectos) {
        $this->validate($objectos, [
            'categorias_eventos_id' => 'required',
            'trabalho' => 'required',
            'local' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'required',
            'hora' => 'required',
        ]);

        DB::beginTransaction();

            $evento = new Evento($objectos->all());
            $evento->categorias_eventos_id = CategoriaEvento::select('id')->where('designacao', '=',$objectos->input('categorias_eventos_id'))->first()['id'];

            if(!$evento->save())
                DB::rollBack();
            else{
                if(! $trabalho = Trabalho::find($objectos->input('trabalho')['id'])->update(['eventos_id'=>$evento['id']]))
                    DB::rollBack();
                else
                    DB::commit();
            }

            return response()->json(['trabalho'=>$trabalho, 'evento'=>$evento]);
    }



    public function getEventosTipo(Request $completo){
            $tipo_evento = CategoriaEvento::select('id')->where('designacao', '=',  ucfirst($completo->get('tipo')))->first()['id'];

            if($completo->exists('paginacao') and ($completo->get('completo') == true)){
                return Auxiliar::retornarDados($this->nomeObjectos, $this->objecto->with($this->relacionados)
                    ->where('categorias_eventos_id', '=', $tipo_evento)
//                    ->join('categorias_eventos', 'eventos.categorias_eventos_id', 'categorias_eventos.id')
                    ->orderBy('eventos.id','desc')
                    ->paginate($completo->input('paginacao')), 200);
            }

            if ($completo->input('completo') == 'true'){
                return Auxiliar::retornarDados($this->nomeObjectos, $this->objecto->with($this->relacionados)
                    ->where('categorias_eventos_id', '=', $tipo_evento)
//                    ->join('categorias_eventos', 'eventos.categorias_eventos_id', 'categorias_eventos.id')
                    ->orderBy('eventos.id','desc')->get(), 200);
            }


            if ($completo->exists('paginacao') and $completo->get('paginacao') > 0){
                return Auxiliar::retornarDados($this->nomeObjectos, $this->objecto
                    ->where('categorias_eventos_id', '=', $tipo_evento)
//                    ->join('categorias_eventos', 'eventos.categorias_eventos_id', 'categorias_eventos.id')
                    ->orderBy('eventos.id','desc')
                    ->paginate($completo->input('paginacao')), 200);
            }

            else
                return Auxiliar::retornarDados($this->nomeObjectos, $this->objecto
                    ->where('categorias_eventos_id', '=', $tipo_evento)
//                    ->join('categorias_eventos', 'eventos.categorias_eventos_id', 'categorias_eventos.id')
                    ->orderBy('eventos.id','desc')->get(), 200);
    }


}
