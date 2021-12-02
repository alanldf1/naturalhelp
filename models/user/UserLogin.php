<?php

/**
 *
 * Classe que configura o crud de sessão
 *
 * @author Willen
 *
 **/
class UserLogin
{

	private $pdoQuery;
	private $userData;

	public function __construct()
	{

		$this->pdoQuery = new PDOQuery;
		$this->userData = new UserSession;

	}
	
	public function getData($username)
	{

		$data = $this->pdoQuery->fetch('SELECT user.*, CASE 
		WHEN user.photo IS NOT NULL THEN CONCAT( CONCAT("/assets/img/profile/", user.id), CONCAT("/photos/", user.photo) ) 
		WHEN user.sex = "masc" THEN "/assets/img/man.jpg" 
		WHEN user.sex = "fem" THEN "/assets/img/woman.jpg" 
		ELSE "/assets/img/noprofile.jpg" 
		END as userphoto, REPLACE(REPLACE(REPLACE(user.phone,"(",""),") ",""),"-", "") as phoneWithoutCaracter,REPLACE(REPLACE(user.email,"@",""),".","") as EmailWithoutCaracter, city.city FROM user
		left outer join city on city.id = user.cityId
		left outer join follows prof on prof.idProfile = user.id
		left outer join follows on follows.idUser = user.id 
		WHERE username = :username OR REPLACE(REPLACE(REPLACE(phone,"(",""),") ",""),"-", "") = :username OR REPLACE(REPLACE(email,"@",""),".","") = :username', array(
			':username' => $username,
		));

		$data['personalinformations'] = $this->getPersonalInformation($data['id']);

		return $data;

	}

	public function checkFollow($userId, $profileId)
	{
		$data = $this->pdoQuery->fetch('SELECT * FROM follows WHERE idUser = :userId AND idProfile = :profileId', array(
			':userId'   => $userId,
			':profileId'=> $profileId
		));

		return $data;
	}

	public function checkFollowers($idProfile)
	{
		$data = $this->pdoQuery->fetch("SELECT followers FROM followers WHERE idProfile = :idProfile", array(
			':idProfile'	=>	$idProfile
		));

		return $data;
	}

	public function checkFollowing($idUser)
	{
		$data = $this->pdoQuery->fetch("SELECT following FROM following WHERE idUser = :idUser", array(
			':idUser'	=>	$idUser
		));

		return $data;
	}

	public function getDataById($id)
	{

		$data = $this->pdoQuery->fetch('SELECT user.*, CASE 
		WHEN user.photo IS NOT NULL THEN CONCAT( CONCAT("/assets/img/profile/", user.id), CONCAT("/photos/", user.photo) ) 
		WHEN user.sex = "masc" THEN "/assets/img/man.jpg" 
		WHEN user.sex = "fem" THEN "/assets/img/woman.jpg" 
		ELSE "/assets/img/noprofile.jpg" 
		END as userphoto, city.city, uf.initials FROM user
		left outer join city on city.id = user.cityId
		left outer join uf on city.id = user.cityId AND city.iduf = uf.id
		left outer join follows prof on prof.idProfile = user.id
		left outer join follows on follows.idUser = user.id
		WHERE user.id = :id', array(
			':id' => $id,
		));

		$data['personalinformations'] = $this->getPersonalInformation($data['id']);

		return $data;

	}

	private function getPersonalInformation($id){

		return $this->pdoQuery->fetch('SELECT * FROM personalinformations WHERE users_id = :id', array(
			':id' => $id,
		));

	}

	private function checkUsernameAndPassword($username, $password, $dbUsername, $dbPassword, $dbPhone, $dbEmail)
	{

		if(strtolower($username) !== strtolower($dbUsername) && $username != $dbPhone && $username != $dbEmail){
			return false;
		}
		
		if($password !== $dbPassword){
			return false;
		}

		return true;

	}


	private function saveData(array $data)
	{

		$pdo = array(
			'id'         		=> $data['id'],
			'name'       		=> $data['username'],
			'password'   		=> $data['password'],
			'validation' 		=> $data['validation'],
			'sex'      			=> $data['sex'],
			'validationcode'    => $data['validationcode'],
			'photo'				=> $data['photo'],
			'type'				=> $data['type'],
			'preference'		=> $data['preference'],
			'status'			=> $data['status'],
			'userphoto'			=> $data['userphoto']
		);

		$this->userData->saveUser($pdo);

	}

	private function setLogin($username, $password)
	{

		$data = $this->getData($username);
		
		if($data and $this->checkUsernameAndPassword($username, $password, $data['username'], $data['password'], $data['phoneWithoutCaracter'], $data['EmailWithoutCaracter'])){

			$this->saveData($data);
			return true;
		}

		return false;

	}


	public function login($username, $password)
	{

		if($this->setLogin($username, hash('sha1',$password))){

			return true;

		}

		return false;

	}

	public function checkUsername($username)
	{
		$data = $this->pdoQuery->fetch('SELECT id FROM user WHERE username = :username OR REPLACE(REPLACE(REPLACE(phone,"(",""),") ",""),"-", "") = :username OR REPLACE(REPLACE(email,"@",""),".","") = :username', array(
			':username' => $username,
		));

		if($data){
			return true;
		}

		return false;

	}
}