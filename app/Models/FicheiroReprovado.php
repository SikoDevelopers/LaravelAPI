<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FicheiroReprovado extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'ficheiros_reprovados';
    protected $fillable = ['motivo', 'data_nova_submissao'];



    public function ficheirosTrabalho(){
        return $this->hasOne('App\Models\FicheirosTrabalho', 'ficheiros_aprovados_id');
    }

}
