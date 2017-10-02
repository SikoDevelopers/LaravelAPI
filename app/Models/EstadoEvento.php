<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoEvento extends Model
{
    protected $table = 'estados_eventos';
    protected $fillable = ['designacao', 'descricao'];



    public function eventos(){
        return $this->belongsToMany('App\Models\Evento', 'eventos_estado_eventos', 'estado_eventos_id', 'eventos_id')
            ->withPivot('id');
    }

}
