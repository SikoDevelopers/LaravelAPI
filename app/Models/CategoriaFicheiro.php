<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaFicheiro extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'categorias_ficheiros';
    protected $fillable = ['designacao', 'descricao'];


    public function ficheirosTrabalhos(){
        return $this->hasMany('App\Models\FicheirosTrabalho', 'categorias_ficheiros_id');
    }

}
