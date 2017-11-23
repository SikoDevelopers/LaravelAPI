<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Docente extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'docentes';
    protected $fillable = ['nome', 'apelido', 'sessao', 'users_id', 'grau_academico_id'];

    protected $with = ['temas', 'areas', 'grauAcademico'];

    public function areas()
    {
        return $this->belongsToMany('App\Models\Area', 'docente_areas','docentes_id','areas_id')->withPivot('id');
    }


    public function temas(){
        return $this->hasMany('App\Models\Tema', 'docentes_id');
    }

    public function grauAcademico(){
        return $this->belongsTo('App\Models\GrauAcademico', 'grau_academico_id');
    }

    public function avaliacoes(){
        return $this->hasMany('App\Models\Avaliacoes', 'docentes_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'users_id');
    }
}










































