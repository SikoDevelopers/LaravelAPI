<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoUser extends Model
{

    use SoftDeletes;
    protected $table = 'tipo_users';
    protected $fillable = ['designacao'];


    public function users(){
        return $this->hasMany('App\User', 'tipo_users_id');
    }
}
