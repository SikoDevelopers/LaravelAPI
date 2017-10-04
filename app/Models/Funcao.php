<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funcao extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'funcoes';
    protected $fillable = ['designacao', 'descricao'];


    public function docentesAreasTrabalhos(){
        return $this->hasMany('App\Models\DocentesAreasTrabalho', 'funcoes_id');
    }



}
