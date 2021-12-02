<?php

/**
 *
 * Classe que configura o crud de sessão
 *
 * @author Willen
 *
 **/
class UserCheck
{

	private $pdoQuery;

	public function __construct()
	{

		$this->pdoQuery = new PDOQuery;

	}

	public function checkUserData($username, $email)
	{

		$response = $this->checkUsername($username);

		if(!$response){
			$response = $this->checkPhone($email);
		}

		return $response;

	}

	public function checkUsernameAndPhone($username, $phone)
	{
		$data['username'] = $this->pdoQuery->fetch('SELECT id FROM user WHERE username = :username', array(
			':username' => $username
		));

		$data['phone'] = $this->pdoQuery->fetch('SELECT id FROM user WHERE phone = :phone AND validation = 1', array(
			':phone' => $phone
		));

		if($data['username'] && $data['phone']){
			$data = $data['username']['id'] == $data['phone']['id'] ? true : false;
		}else{
			$data = false;
		}

		return $data;
	}

	public function checkUser($username)
	{

		$response = $this->pdoQuery->fetch("SELECT * FROM user WHERE username = :username", array(
			':username'	=> $username,
		));

		return $response;

	}

	public function checkUserPhone($phone)
	{
		return $this->pdoQuery->fetch('SELECT id FROM user WHERE phone = :phone AND validation = 1', array(
			':phone' => $phone
		));
	}
	public function checkUserEmail($email)
	{
		$email = $this->pdoQuery->fetch('SELECT id FROM user WHERE email = :email AND validation = 1 AND validateemail = 1', array(
			':email' => $email
		));
		return $email;
	}

	public function checkEmail($email)
	{
		return $this->pdoQuery->fetch("SELECT id FROM user WHERE email = :email AND validation = 1", array(
			':email' => $email
		));
	}

	private function checkUsername($username)
	{

		$data = $this->pdoQuery->fetch('SELECT id FROM user WHERE username = :username', array(
			':username' => $username
		));

		return (!$data) ? false : 'Nome de usuário já em uso';
		
	}

	private function checkPhone($phone)
	{

		$data = $this->pdoQuery->fetch('SELECT id FROM user WHERE phone = :phone AND validation = 1', array(
			':phone' => $phone
		));

		return (!$data) ? false : 'Celular já em uso';

	}

	public function checkValidationCode($id, $code)
	{

		$data = $this->pdoQuery->fetch('SELECT id FROM user WHERE validationcode = :code AND id = :id', array(
			':id'   => $id,
			':code' => $code
		));

		return ($data) ? true : 'Código Inválido';

	}

}