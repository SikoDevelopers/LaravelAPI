<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{
    protected $table = 'funcoes';
    protected $fillable = ['designacao', 'descricao'];


    public function docentesAreasTrabalhos(){
        return $this->hasMany('App\Models\DocentesAreasTrabalho', 'funcoes_id');
    }



}
