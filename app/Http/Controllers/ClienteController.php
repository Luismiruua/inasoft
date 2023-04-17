<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function registroUsuario(Request $request){
        $request->validate([
            'name' => 'required|string',
            'usuario' => 'required|'
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user' => $request->user,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'Usuario creado correctamente'
        ], 201);
    }

    public function inicioSesion(Request $request){
        //valida la entrada de datos al servidor

        if($request->email){
            $datos = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]);
        }else{
            $datos = $request->validate([
                'name' => 'required|string',
                'password' => 'required|string'
            ]);
        }
            if(!Auth::attempt($datos))
                return response()->json([
                    'message' => 'No estás autorizado, lo siento'],
                401);


        $user = $request->user();
        $tokenResultado = $user->createToken('Personal acces Token');
        $token = $tokenResultado->token;

        return response()->json([
            'info' =>  Auth::guard('api')->user(),
            'access_token' => $tokenResultado->accessToken,
        ]);
    }


    public function logout(){
        Auth::guard('api')->user()->tokens()->delete();

        return response()->json([
            "message" => "Ha salido de su cuenta",
        ]);
    }
}
