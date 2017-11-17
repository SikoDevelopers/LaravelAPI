<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avaliacoes extends Model
{
    protected $table = 'avaliacoes';
    protected $fillable = ['parecer', 'data_limite', 'data', 'docentes_id', 'fase', 'parecer_final', 'avaliacaoFinal'];

    protected $with = ['docente'];

    public function docente(){
        return $this->belongsTo('App\Models\Docente', 'docentes_id');
    }

    public function ficheirosTrabalho(){
        return $this->hasOne('App\Models\FicheirosTrabalho', 'avaliacoes_id');
    }


}










































