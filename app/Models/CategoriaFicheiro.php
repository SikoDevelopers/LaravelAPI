<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaFicheiro extends Model
{
    protected $table = 'categorias_ficheiros';
    protected $fillable = ['designacao', 'descricao'];


    public function ficheirosTrabalhos(){
        return $this->hasMany('App\Models\FicheirosTrabalho', 'categorias_ficheiros_id');
    }

}
