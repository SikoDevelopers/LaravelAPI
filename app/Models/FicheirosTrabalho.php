<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FicheirosTrabalho extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'ficheiros_trabalhos';
    protected $fillable = ['caminho', 'data', 'categorias_ficheiros_id', 'trabalhos_id', 'ficheiros_aprovados_id', 'avaliacoes_id'];

    protected $with = ['categoriaFicheiro', 'estadoFicheiros', 'ficheiroReprovado','avaliacao'];


    public function categoriaFicheiro(){
        return $this->belongsTo('App\Models\CategoriaFicheiro', 'categorias_ficheiros_id');
    }


    public function trabalho(){
        return $this->belongsTo('App\Models\Trabalho', 'trabalhos_id');
    }

    public function estadoFicheiros(){
        return $this->belongsToMany('App\Models\EstadoFicheiro', 'ficheiros_trabalhos_estados_ficheiros',
             'ficheiros_trabalhos_id', 'estados_ficheiros_id')
            ->withPivot('id', 'data', 'is_actual');
    }


    public function ficheiroReprovado(){
        return $this->belongsTo('App\Models\FicheiroReprovado', 'ficheiros_aprovados_id');
    }

    public function avaliacao(){
        return $this->belongsTo('App\Models\Avaliacoes', 'avaliacoes_id');
    }


}
