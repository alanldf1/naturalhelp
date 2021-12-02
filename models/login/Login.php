<?php

/**
*
* Model de Login
*
* @author Code Universe
*
**/
class Login {

	private $pdoQuery;

	public function __construct(){
		$this->pdoQuery = new PDOQuery;
	}

	public function logar($dados){

		$email     		= $dados['email'];
		$password       = SHA1($dados['senha']);

		return $this->pdoQuery->fetch("SELECT * FROM admin WHERE login = '$email' AND password = '$password'");

	}

}