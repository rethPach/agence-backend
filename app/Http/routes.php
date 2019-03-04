<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'AgenceHomeController@index');
Route::get('test', 'TestController@test');


Route::get('api/listado-consultores', 'ApiAgenceController@listadoConsultores');
Route::get('api/listado-consultores-get-by-type', 'ApiAgenceController@listadoConsultoresGetByType');
Route::get('api/facturas-consultor', 'ApiAgenceController@faturasConsultor');
Route::get('api/desempeno-consultores', 'ApiAgenceController@desempenoConsultores');
