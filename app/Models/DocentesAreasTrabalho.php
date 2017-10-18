<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocentesAreasTrabalho extends Model
{
    protected $table = 'docente_areas_trabalhos';
    protected $fillable = ['docente_areas_id', 'trabalhos_id', 'funcoes_id'];

    protected $with = ['funcao'];

    public function funcao(){
        return $this->belongsTo('App\Models\Funcao', 'funcoes_id');
    }




}
