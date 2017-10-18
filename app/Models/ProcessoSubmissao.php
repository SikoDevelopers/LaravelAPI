<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessoSubmissao extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'processo_submissao';
    protected $fillable = ['data_inicio', 'data_fim', 'tipo_processo'];
}
