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


}
