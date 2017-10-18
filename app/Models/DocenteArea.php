<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocenteArea extends Model
{
    protected $table = 'docente_areas';

    protected $fillable=['docentes_id','areas_id'];




    //Muitos para muitos
    public function trabalhos(){
        return $this->belongsToMany('App\Models\Trabalho', 'docente_areas_trabalhos', 'docente_areas_id', 'trabalhos_id')
            ->withPivot('id', 'funcoes_id');
    }





}
