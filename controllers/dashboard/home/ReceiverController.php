<?php

/**
*
* Controller do administrador
*
* @author Code Universe
*
**/
class AdminController extends Controller
{
	public function index(){

		$usuarios = new Usuarios;

		if($_COOKIE['login'] != ''){

			$this->setLayout('administrador/dashboard.php');
			$this->view('administrador/recebedor.php', array(
				'usuarios' => $usuarios->getAll('recebedor')
			));

		}else{
			header('Location: ../dashboard');
		}

	}
}