<?php
namespace App\Http\Controllers\classesAuxiliares;


/**
 * Esta eh uma classe que contera alguns metodos auxiliares
 * User: herquiloidehele
 * Date: 10/4/17
 * Time: 07:39
 */

class Auxiliar {


    /**
     * retorna uma mensagem em JSON de erro passada um mensagem e o seu status
     * @param $mensagem
     * @param $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function retornarErros($mensagem, $status) {
        return response()->json(['mensagem' => $mensagem, 'status' => $status]);
    }



    public static function retornarDados($nome_dado, $dado, $status){
       return  response()->json([''.$nome_dado => $dado, 'status' => $status]);
    }

}