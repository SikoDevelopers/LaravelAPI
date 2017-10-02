<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudante extends Model
{
    protected $table = 'estudantes';
    protected $fillable = ['nome', 'apelido', 'data_nascimento', 'morada', 'sessao', 'cursos_id'];

    public function curso(){
        return $this->belongsTo('App\Models\Curso', 'cursos_id');
    }


    public function trabalho(){
        return $this->hasOne('App\Models\Trabalho', 'estudantes_id');
    }


}
