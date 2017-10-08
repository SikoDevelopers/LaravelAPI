<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticateble;
use Illuminate\Notifications\Notifiable;

class User extends Authenticateble
{
    use Notifiable;

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    protected $table = 'users';
    protected $fillable = ['email', 'password', 'tipo_users_id'];


    public function tipoUser(){
        return $this->belongsTo('App\Models\TipoUser','tipo_users_id' );
    }


    public function funcionario(){
        return $this->hasOne('App\Models\Funcionario','users_id');
    }


    public function docente(){
        return $this->hasOne('App\Models\Docente','users_id');
    }

    public function estudante(){
        return $this->hasOne('App\Models\Estudante','users_id');
    }

    public function supervisorExterno(){
        return $this->hasOne('App\Models\SupervisorExterno','users_id');
    }


    public function directorCurso(){
        return $this->hasOne('App\Models\DirectorCurso','users_id');
    }




}
