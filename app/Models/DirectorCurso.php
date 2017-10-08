<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirectorCurso extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'directores_cursos';
    protected $fillable = ['nome', 'apelido', 'cursos_id', 'users_id'];


    public function curso(){
        return $this->belongsTo('App\Models\Curso', 'cursos_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'users_id');
    }




}
