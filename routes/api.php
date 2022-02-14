<?php

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

//12 Posso lavorare in due modi. Questo il primo:
// Route::get('posts', 'Api\PostsController@index');
// Route::get('posts/{slug}', 'Api\PostsController@index');

//13 §questo il secondo:
// come si vede è più compatta ed è esattamente la stessa cosa se si capisce lalogica. Cerchiamo di capirla:

//14 il namespace corrisponde al percorso del controller (come si vede sù c'è Api, giù no)
Route::namespace('Api')
// il prefix va dopo lo / della home
   ->prefix('posts')
   //15 fin qui tutto uguale per tutte le rotte ape, ciò che segue (che sarà scritto dalla funzione axios [con le su apiUrl] all'interno dei componenti dove viene chiamato) farà scattare una delle due funzioni raggruppate: ossia l'index se dopo posts non viene aggiunto niente, show se dopo posts viene concatenato con le regole api rest
   ->group(function(){
      Route::get('/', 'PostsController@index');
      Route::get('{slug}', 'PostsController@show');
      Route::get('postcategory/{slug}', 'PostsController@getPostsByCategory');
      Route::get('posttag/{slug}', 'PostsController@getPostsByTags');
   });
