<?php

// Nos mostrará el formulario de login.
Route::get('login', 'AuthController@showLogin');

// Validamos los datos de inicio de sesión.
Route::post('login', 'AuthController@postLogin');

// Nos indica que las rutas que están dentro de él sólo serán mostradas si antes el usuario se ha autenticado.
Route::group(array('before' => 'auth'), function()
{
	// Esta será nuestra ruta de bienvenida.
	
	Route::get('/', 'HomeController@home');

	Route::get('gestionProfesores', 'HomeController@altaProfesores');
	Route::post('gestionProfesores', 'HomeController@postaltaProfesores');

	Route::get('gestionartt', 'HomeController@altatt');
	Route::post('gestionartt', 'HomeController@postAltatt');


	// Esta ruta nos servirá para cerrar sesión.
	Route::get('logout', 'AuthController@logOut');
});