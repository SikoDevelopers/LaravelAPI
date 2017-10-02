<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoFicheiro extends Model
{
    protected $table = 'estados_ficheiros';
    protected $fillable = ['designacao', 'descricao'];



    public function ficheirosTrabalhos(){
        return $this->belongsToMany('App\Models\FicheirosTrabalho', 'ficheiros_trabalhos_estados_ficheiros',
            'estados_ficheiros_id', 'ficheiros_trabalhos_id')
            ->withPivot('id', 'data', 'is_actual');
    }

}
