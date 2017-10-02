<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectorCurso extends Model
{
    protected $table = 'directores_cursos';
    protected $fillable = ['nome', 'apelido', 'cursos_id'];


    public function curso(){
        return $this->belongsTo('App\Models\Curso', 'cursos_id');
    }
}
