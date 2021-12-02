<?php

/**
*
* Model de mensagens
*
* @author Code Universe
*
**/
class Mensagens {

	public function __construct(){
		$this->pdoCrud  = new PDOCrud;
		$this->pdoQuery = new PDOQuery;
	}

	public function getAll(){

		return $this->pdoQuery->fetchAll("SELECT * FROM mensagens ORDER by id DESC");

	}

	public function cadastro($dados){

		$nome     = $dados['nome'];
		$email    = $dados['email'];
		$tel      = $dados['tel'];
		$mensagem = $dados['mensagem'];

		$pdo = array(
				':nome'     => $nome,
				':email'    => $email,
				':tel'      => $tel,
				':mensagem' => $mensagem
			);

		$columns = 'nome, email, telefone, mensagem';
		$values  = ':nome, :email, :tel, :mensagem';

		return $this->pdoCrud->insert('mensagens', $columns, $values, $pdo);

	}

}