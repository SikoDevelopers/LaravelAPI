<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrauAcademico extends Model
{
    protected $dates = ['deleted_at'];

    protected $table = 'grau_academico';
    protected $fillable = ['designacao'];


    public function coSupervisores()
    {
        return $this->hasMany('App\Models\CoSupervisor', 'grau_academico_id');
    }


    public function docentes()
    {
        return $this->hasMany('App\Models\Docente', 'docentes_id');
    }


}


