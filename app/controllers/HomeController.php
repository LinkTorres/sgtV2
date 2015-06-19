<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
		{
		return View::make('hello');
		}

	public function home()
	{
		return View::make('indexCATT');
	}

	public function altaProfesores()
	{
		return View::make('GestionarProfesores');
	}

	public function postaltaProfesores()
	{
		$cedula = e(Input::get('cedula')); 
		$nombre = e(Input::get('nombre')); 
		$ap = e(Input::get('ap'));
		$am = e(Input::get('am'));
		$genero = e(Input::get('genero'));
		$cargo = e(Input::get('cargo'));
		$mail = e(Input::get('mail'));

		$pro = DB::table('Profesor')->where('Cedula',$cedula)->pluck('Cargo');
		if(count($pro)>0)
		{
			$error = 'Ya has registrado a este profesor';
			return Redirect::to('gestionProfesores')
					->with('error',$error)
				    ->withInput();
		}
		else
		{
			$pro=DB::table('Profesor')->where('Cargo','Director')->pluck('Cargo');
			$pro2=DB::table('Profesor')->where('Cargo','Subdirector')->pluck('Cargo');
			if(count($pro)>0 and count($pro2)>0)
			{
				$error = 'Ya hay un profesor con ese cargo.';
				return Redirect::to('gestionProfesores')
					->with('error',$error)
				    ->withInput();
			}
			else
			{
				$id = DB::table('Usuario')->insertGetId(array('Nombre' => $nombre, 'ApellidoP' => $ap, 'ApellidoM' => $am, 'Genero' => $genero,'Correo' => $mail,'Rol' => 'Profesor'));
				DB::table('Profesor')->insert(array('Cedula' => $cedula, 'Cargo' => $cargo, 'Usuario_id_Usuario' => $id));
				return Redirect::to('login');
			}
		}
		
	}

	public function altatt()
	{
		return View::make('GestionarTT');
	}

}