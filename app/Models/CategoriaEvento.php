<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaEvento extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'categorias_eventos';
    protected $fillable = ['descricao', 'designacao'];


    public function eventos(){
        return $this->hasMany('App\Models\CategoriaEvento', 'categorias_eventos_id');
    }


}
