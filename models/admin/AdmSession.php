<?php

/**
*
* Classe que manipula os dados do admin na sessão.
*
* @author Emprezaz.com
* 
**/
class AdmSession
{

	private function control()
	{
		
		if(!isset($_SESSION)){
			
			session_start();

		}

	}

	public function save($data)
	{

		$this->control();
		$_SESSION['Adm'] = $data;
		return true;
		
	}


	public function has()
	{

		$this->control();

		if(isset($_SESSION['Adm'])){
			return true;
		}

		return false;

	}

	public function get($info)
	{

		$this->control();

		if(isset($_SESSION['Adm'][$info])){
			return $_SESSION['Adm'][$info];
		}

	}


	public function set($info, $value)
	{

		$this->control();

		$_SESSION['Adm'][$info] = $value;

	}

	public function delete()
	{

		$this->control();
		unset($_SESSION['Adm']);

	}

	// public function getAlerts(){

	// 	$userData = new UserData;
	// 	$alerts = $userData->getAlertsNonwiewed();

	// 	return $alerts;
	// }

}