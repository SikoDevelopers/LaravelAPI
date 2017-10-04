<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tema extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'temas';
    protected $fillable = ['designacao', 'docentes_id', 'areas_id'];



    public function docente(){
        return $this->belongsTo('App\Models\Docente', 'docentes_id');
    }

    public function area(){
        return $this->belongsTo('App\Models\Area', 'areas_id');
    }


}
