<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    protected $table = 'temas';
    protected $fillable = ['designacao', 'docentes_id', 'areas_id'];



    public function docente(){
        return $this->belongsTo('App\Models\Docente', 'docentes_id');
    }

    public function area(){
        return $this->belongsTo('App\Models\Area', 'areas_id');
    }


}
