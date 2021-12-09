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

		$mensagens = new Mensagens;

		if($_COOKIE['login'] != ''){

			$this->setLayout('administrador/dashboard.php');
			$this->view('administrador/mensagens.php', array(
				'mensagens' => $mensagens->getAll()
			));

		}else{
			header('Location: ../dashboard');
		}

	}
}