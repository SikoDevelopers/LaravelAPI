<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupervisorExterno extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'supervisor_externos';
    protected $fillable = ['nome', 'apelido', 'users_id'];


    public function areas()
    {
        return $this->belongsToMany('App\Models\Area', 'areas_supervisor_externos','supervisor_externos_id','areas_id')
            ->withPivot('id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'users_id');
    }

}
