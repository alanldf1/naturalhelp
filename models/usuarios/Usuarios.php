<?php

/**
*
* Model de Usuários
*
* @author Code Universe
*
**/
class Usuarios {

	public function __construct(){
		$this->pdoCrud = new PDOCrud;
		$this->pdoQuery = new PDOQuery;
	}

	public function getAll($type = false){

		if(!$type)
		{
			return $this->pdoQuery->fetchAll("SELECT * FROM usuarios ORDER by id DESC");

		}else {

			return $this->pdoQuery->fetchAll("SELECT * FROM usuarios WHERE tipo = '$type' ORDER by id DESC");
		}


	}

	public function cadastro($dados){

		$nome  = $dados['nome'];
		$email = $dados['email'];
		$tel   = $dados['tel'];
		$doc   = $dados['doc'];
		$tipo  = $dados['tipo'];

		$pdo = array(
				':nome'  => $nome,
				':email' => $email,
				':tel'   => $tel,
				':doc'   => $doc,
				':tipo'  => $tipo
			);

		$columns = 'nome, email, telefone, doc, tipo';
		$values  = ':nome, :email, :tel, :doc, :tipo';

		return $this->pdoCrud->insert('usuarios', $columns, $values, $pdo);

	}

}