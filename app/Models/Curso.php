<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'cursos';
    protected $fillable = ['designacao'];

//    public $with = ['estudantes', 'directorCurso'];

    public function estudantes(){
        return $this->hasMany('App\Models\Estudante', 'cursos_id');
    }


    public function directorCurso(){
        return $this->hasOne('App\Models\DirectorCurso', 'cursos_id');
    }
}
