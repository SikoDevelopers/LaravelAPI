<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class UserController extends Controller
{



    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $credencias = $request->only(['email', 'password']);

        try{
            if(! $token = \Tymon\JWTAuth\JWTAuth::attempt($credencias))
                return response()->json(['mensagem' => 'Credencias Erradas', 'status' => 401], 401);
        }catch (JWTException $ex){
            return response()->json(['mensagem' => 'Erro ao gerar token', 'status' => 500], 500);
        }

        $user = $this->getUser(new Request(['token' => $token]));

        return response()->json(['token' => $token, 'user' => $user, 'status' => 200], 200);
    }



    public function validarEmail(Request $request){
        $this->validate($request, [
            'email' => 'required|email|unique:users'
            ]);

        return response()->json(['estado'=>'valido', 'email'=> $request->input('email')], 200);
    }



    public function getUser(Request $request){
        $user = JWTAuth::toUser($request->token);

//        $user = \Tymon\JWTAuth\JWTAuth::parseToken()->authenticate();

        return $user;
    }


   





}
