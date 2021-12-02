<?php

/**
 * 
 * Data do dashboard
 * 
 * @author Emprezaz
 * 
**/

class DashboardData{

    private $pdoQuery;
    private $pdoCrud;

    public function __construct(){

        $this->pdoQuery = new PDOQuery;
        $this->pdoCrud = new PDOCrud;

    }

    // Buscando nome de usuário no banco
    public function checkUsernameAdm($username){

        return $this->pdoQuery->fetch("SELECT id, login FROM admin WHERE login = :username ", array(
            ':username' => $username,
        ));

    }
    // Buscando nome de usuário no banco
    public function checkEmailAdm($email){

        return $this->pdoQuery->fetch("SELECT id, email FROM admin WHERE email = :email ", array(
            ':email' => $email,
        ));

    }
    // Buscando nome de usuário no banco
    public function checkIdAdm($email){
        $id = $this->pdoQuery->fetch("SELECT id,email FROM admin WHERE email = :email ", array(
            ':email' => $email,
        ));
        return $id;

    }
    // Buscando nome de usuário no banco
    public function checkRecoverValidateAdm($id,$code){
        
        $id = $this->pdoQuery->fetch("SELECT id,email,recoverpasscode FROM admin WHERE id = :id AND recoverpasscode = :recoverpasscode", array(
            ':id' => $id,
            ':recoverpasscode' => $code,
        ));
        return $id;

    }

    // Buscando a senha do usuário no banco
    public function checkPasswordAdm($username, $password){

        $password = SHA1($password);

        return $this->pdoQuery->fetch("SELECT * FROM admin WHERE login = :username AND password = :password ", array(
            ':username' => $username,
            ':password' => $password,
        ));

    }

    // Buscando os dados da sessão
    public function getData($username){

        return $this->pdoQuery->fetch("SELECT * FROM admin WHERE login = :username ", array(
            ':username' => $username,
        ));

    }

    public function getDataById($id)
    {
        return $this->pdoQuery->fetch("SELECT * FROM admin WHERE id = :id ", array(
            ':id' => $id,
        ));
    }

    public function submitAdmin($data)
    {
        if(isset($data['id'])){
			return $this->updateAdmin($data);
		}else{
			return $this->registerAdmin($data);
		}
    }

    public function registerAdmin($data)
    {
        $pdo = array(
			':nome'     => $data['nome'],
			':login'    => $data['login'],
            ':password' => $data['password'],
		);

		$columns = 'nome, login, password';
		$values = ':nome, :login, :password';

		return $this->pdoCrud->insert('admin', $columns, $values, $pdo);
    }

    public function updateAdmin($data)
    {
        $pdo = array(
            ':id'       => $data['id'],
			':nome'     => $data['nome'],
			':login'    => $data['login'],
            ':password' => $data['password'],
		);

		$clausule = ' WHERE id = :id';
		$values = 'nome = :nome, login = :login, password = :password';

		return $this->pdoCrud->update('admin', $values, $clausule, $pdo);
    }

}