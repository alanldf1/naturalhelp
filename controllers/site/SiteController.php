<?php
/**
*
* Controller do site.
*
* @author Alan de Souza
*
**/
class SiteController extends Controller
{


	public function quemSomos()
	{

		$this->setLayout('site/layout.php');
		$this->view('site/quem-somos.php');

	}

	public function nosapoie()
	{

		$this->setLayout('site/layout.php');
		$this->view('site/nos-apoie.php');

	}

	public function doacoes()
	{

		$this->setLayout('site/layout.php');
		$this->view('site/doacoes.php');

	}

	public function ongs()
	{

		$this->setLayout('site/layout.php');
		$this->view('site/ongs.php');

	}

	public function contato()
	{

		$this->setLayout('site/layout.php');
		$this->view('site/contato.php');

	}

	public function cadastro(){

		$usuarios = new Usuarios;
		$cadastro = $usuarios->cadastro($_POST);

		echo json_encode(true);

	}

	public function mensagem(){

		$mensagens = new Mensagens;
		$mensagem = $mensagens->cadastro($_POST);

		echo json_encode(true);

	}
}