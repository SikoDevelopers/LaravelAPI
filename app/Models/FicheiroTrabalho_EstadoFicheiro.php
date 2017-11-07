<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FicheiroTrabalho_EstadoFicheiro extends Model
{
    protected $table = 'ficheiros_trabalhos_estados_ficheiros';
    protected $fillable = ['ficheiros_trabalhos_id', 'estados_ficheiros_id', 'parecer'];
}
