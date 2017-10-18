<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreasSupervisorExterno extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'areas_supervisor_externos';
    protected $fillable = ['areas_id', 'supervisor_externos_id'];



    public function trabalhos(){
        return $this->hasMany('App\Models\Trabalho','areas_supervisor_externos_id');
    }

}


//Complexo sala 104 9h-10h