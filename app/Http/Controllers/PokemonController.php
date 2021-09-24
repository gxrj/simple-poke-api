<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;
use Auth;
class PokemonController extends Controller
{
    public function create( Request $req ){
        $user = Auth::user();

        Pokemon::create([ 
            'nome'    => $req->nome,
            'tipo'    => $req->tipo,
            'peso'    => $req->peso,
            'user_id' => $user->id
        ]);

        return response()->json(['mensagem' => 'pokemon cadastrado']);
    }

    public function update( Request $req ){
        $user = Auth::user();

        $res = Pokemon::where('user_id', $user->id )
                        ->where( 'id', $req->id )
                            ->update( [   
                                    'nome'    => $req->nome,
                                    'tipo'    => $req->tipo,
                                    'peso'    => $req->peso
                            ] );

        if($res) return response()->json(['mensagem' => 'Sucesso, pokemon atualizado']);

        return response()->json(['mensagem' => 'Fracasso']);
    }

    public function retrieve( Request $req ){

        $user = Auth::user();

        $lista = Pokemon::where( 'user_id', $user->id )
                            ->get();
        
        return response()->json([
            'mensagem' => 'lista de pokemons de '. $user->name,
            'pokemons' => $lista
        ]);
    }

    public function delete( Request $req ){
        $user = Auth::user();

        $res = Pokemon::where('user_id', $user->id )
                        ->where( 'id', $req->id )
                            ->delete();

        if($res) return response()->json(['mensagem' => 'Deletado']);
        else return response()->json(['mensagem' => 'Deletado não existe']);
    }
}
