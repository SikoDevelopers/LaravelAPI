<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'areas';
    protected $fillable = ['designacao'];


    public function docentes()
    {
        return $this->belongsToMany('App\Models\Docente', 'docente_areas','areas_id','docentes_id');
    }

    public function temas(){
        return $this->hasMany('App\Models\Tema', 'areas_id');
    }


}


