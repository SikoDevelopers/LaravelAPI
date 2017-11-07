<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoSupervisor extends Model
{
    protected $dates = ['deleted_at'];

    protected $table = 'co_supervisores';
    protected $fillable = ['designacao', 'grau_academico_id'];


    public function trabalhos()
    {
        return $this->hasMany('App\Models\Trabalho','co_supervisores_id');
    }


    public function grauAcademico(){
        return $this->belongsTo('App\Models\GrauAcademico', 'grau_academico_id');
    }


}


