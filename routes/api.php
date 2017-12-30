<?php

use Illuminate\Http\Request;

use App\Models\Boisson;
use App\Models\Sandwitch;
use App\Models\Dessert;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('boissons', 'BoissonAPIController');

Route::resource('desserts', 'DessertAPIController');

Route::resource('sandwitches', 'SandwitchAPIController');

Route::get('/menu', function () {

  $sandwitches = Sandwitch::all()->random(1);
  $boissons = Boisson::all()->random(1);
  $desserts = Dessert::all()->random(1);

  $menu = new stdClass();
  @$menu->generated = true;
  @$menu->data->boisson = $boissons[0];
  @$menu->data->sandwitch = $sandwitches[0];
  @$menu->data->dessert = $desserts[0];

  return json_encode($menu);
});
