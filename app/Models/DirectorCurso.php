<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirectorCurso extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'directores_cursos';
    protected $fillable = ['nome', 'apelido', 'cursos_id'];


    public function curso(){
        return $this->belongsTo('App\Models\Curso', 'cursos_id');
    }
}
