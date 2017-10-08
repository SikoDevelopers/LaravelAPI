<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estudante extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'estudantes';
    protected $fillable = ['nome', 'apelido', 'data_nascimento', 'morada', 'sessao', 'cursos_id', 'users_id'];

//    public $with = ['curso', 'trabalho'];

    public function curso(){
        return $this->belongsTo('App\Models\Curso', 'cursos_id');
    }


    public function trabalho(){
        return $this->hasOne('App\Models\Trabalho', 'estudantes_id');
    }


    public function user(){
        return $this->belongsTo('App\User', 'users_id');
    }

}
