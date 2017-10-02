<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaEvento extends Model
{
    protected $table = 'categorias_eventos';
    protected $fillable = ['descricao', 'designacao'];


    public function eventos(){
        return $this->hasMany('App\Models\CategoriaEvento', 'categorias_eventos_id');
    }


}
