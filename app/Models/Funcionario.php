<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funcionario extends Model
{
    use SoftDeletes;
    protected $table = 'funcionarios';
    protected $fillable  = ['nome', 'apelido','users_id'];

    public function user(){
        return $this->belongsTo('App\User', 'users_id');
    }
}
