<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class SignController extends Controller
{
    public function SignIn( Request $req){
        $cred = $req->validate( [ 'email' => 'email|required', 'password' => 'required'] );
        $autenticado = Auth::attempt( $cred );

        if( !$autenticado ) return response()->json(['mensagem' => 'Credenciais invalidas']);

        $user = Auth::user();
        $token = $user->createToken('pokeToken')->accessToken;

        return response()
                    ->json( [ 'nome' => $user->name, 'email' => $user->email, 'access_token' => $token ] );
    }

    public function SignUp( Request $req){
    
        User::create( [
            'name'     => $req->name,
            'email'    => $req->email,
            'password' => Hash::make( $req->password )
        ] );

        return response()->json( ['mensagem' => 'Cadastro concluido'] );
    }

    public function SignOut( Request $req){
        $exito = $req->user()->token()->delete();

        if( !$exito ) return response()->json(['mensagem' => 'falha na autenticação']);

        return response()->json( ['mensagem' => 'deslogado com sucesso'] );
    }
}
