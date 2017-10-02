<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'docentes';
    protected $fillable = ['nome', 'apelido', 'sessao'];


    public function areas()
    {
        return $this->belongsToMany('App\Models\Area', 'docente_areas','docentes_id','areas_id')->withPivot('id');
    }


    public function temas(){
        return $this->hasMany('App\Models\Tema', 'docentes_id');
    }


}










































