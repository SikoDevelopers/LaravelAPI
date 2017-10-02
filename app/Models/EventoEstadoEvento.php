<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventoEstadoEvento extends Model
{
    protected $table = 'eventos_estado_eventos';
    protected $fillable = ['estado_eventos_id', 'eventos_id'];

}
