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
		$Profes= DB::table('Usuario')
            ->join('Profesor', 'Usuario.id_Usuario', '=', 'Profesor.Usuario_id_Usuario')
            ->where('Rol','Profesor')
            ->get();
        Log::info("Logging an array: " . print_r($Profes, true));

		return View::make('GestionarProfesores',$Profes)
		->with('Profes',$Profes);
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

	public function PostAltatt()
	{
		$numtt = e(Input::get('numerott')); 
		$nombrett = e(Input::get('nombrett')); 
		$pasante1 = e(Input::get('pasante1')); 
		$pasante2 = e(Input::get('pasante2')); 
		$pasante3 = e(Input::get('pasante3')); 
		$pasante4 = e(Input::get('pasante4')); 
		$pasante5 = e(Input::get('pasante5')); 
		$director1 = e(Input::get('director1'));
		$director2 = e(Input::get('director2')); 
		$sinodal1 = e(Input::get('sinodal1')); 
		$sinodal2 = e(Input::get('sinodal2')); 
		$sinodal3 = e(Input::get('sinodal3')); 

		//revisar que no haya pasante

		if(strlen(pasante2))
		{
			if (strlen(pasante3)) 
			{
				if (strlen(pasante4)) 
				{
					if (strlen(pasante5)) 
					{
						
					}
					else
					{

					}
				}
				else
				{

				}
			}
			else
			{

			}
		}
		else
		{

		}
	}

}