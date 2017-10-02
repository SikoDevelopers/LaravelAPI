<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';
    protected $fillable = ['data', 'data_inicio', 'data_fim', 'local', 'hora', 'agenda', 'telefone', 'email', 'categorias_eventos_id'];

    public function trabalho(){
       return $this->hasOne('App\Models\Trabalho', 'eventos_id');
    }

    public function categoriaEvento(){
        return $this->belongsTo('App\Models\CategoriaEvento', 'categorias_eventos_id');
    }


    public function estadoEventos(){
        return $this->belongsToMany('App\Models\EstadoEvento', 'eventos_estado_eventos', 'eventos_id', 'estado_eventos_id')
            ->withPivot('id');
    }



}
