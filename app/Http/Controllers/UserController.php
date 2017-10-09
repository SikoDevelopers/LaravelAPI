<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
class UserController extends Controller
{



    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $credencias = $request->only(['email', 'password']);

        try{
            if(! $token = JWTAuth::attempt($credencias))
                return response()->json(['mensagem' => 'Credencias Erradas'], 401);
        }catch (JWTException $ex){
            response()->json(['mensagem' => 'Erro ao gerar token'], 500);
        }
//        $user = $this->getUser();
        return response()->json(['token' => $token], 200);


    }



    public function getUser(Request $request){
        $user = JWTAuth::toUser($request->token);
        $user->tipoUser;
        $user->docente;

        return response()->json(['user' => $user], 200);
    }




}
