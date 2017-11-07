<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trabalho extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'trabalhos';
    protected $fillable = ['titulo', 'descricao', 'estudantes_id', 'eventos_id', 'is_aprovado', 'areas_supervisor_externos_id'];
    protected $with = ['estudante'];


    public function estudante(){
        return $this->belongsTo('App\Models\Estudante', 'estudantes_id');
    }


    public function ficheirosTrabalhos(){
        return $this->hasMany('App\Models\FicheirosTrabalho', 'trabalhos_id');
    }


    public function evento(){
        return $this->belongsTo('App\Models\Evento', 'eventos_id');
    }


    //Muitos para muitos
    public function docenteAreas(){
        return $this->belongsToMany('App\Models\DocenteArea', 'docente_areas_trabalhos','trabalhos_id', 'docente_areas_id')
            ->withPivot('id', 'funcoes_id');
    }


    public function supervisor($docente_areas_id,$trabalhos_id){

        return DocentesAreasTrabalho::where(['docente_areas_id'=>$docente_areas_id],['trabalhos_id'=>$trabalhos_id],['funcoes_id'=>1]);
    }

    public function areaSupervisorExterno(){
        return $this->belongsTo('App\Models\AreasSupervisorExterno', 'areas_supervisor_externos_id');
    }

}
