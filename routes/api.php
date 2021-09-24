<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post( 'login', [ SignController::class, 'SignIn' ] );
Route::post( 'cadastro', [ SignController::class, 'SignUp' ] );

Route::middleware('auth:api')->group( function () {
   Route::post( 'logout', [ SignController::class, 'SignOut' ]  );
   Route::post( 'create', [ PokemonController::class, 'create' ]  );
   Route::post( 'update', [ PokemonController::class, 'update' ]  );
   Route::post( 'retrieve', [ PokemonController::class, 'retrieve' ]  );
   Route::post( 'delete', [ PokemonController::class, 'delete' ]  );
});
