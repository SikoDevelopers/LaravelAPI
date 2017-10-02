<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';
    protected $fillable = ['designacao'];



    public function estudantes(){
        return $this->hasMany('App\Models\Estudante', 'cursos_id');
    }


    public function directorCurso(){
        return $this->hasOne('App\Models\DirectorCurso', 'cursos_id');
    }
}
