<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FicheiroReprovado extends Model
{
    protected $table = 'ficheiros_reprovados';
    protected $fillable = ['motivo', 'data_nova_submissao'];



    public function ficheirosTrabalho(){
        return $this->hasOne('App\Models\FicheirosTrabalho', 'ficheiros_aprovados_id');
    }

}
