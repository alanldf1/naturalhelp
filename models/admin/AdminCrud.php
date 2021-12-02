<?php

/**
 * 
 * Data do dashboard
 * 
 * @author Emprezaz
 * 
**/

class AdminCrud{

    private $pdoQuery;
    private $pdoCrud;

    public function __construct(){

        $this->pdoQuery = new PDOQuery;
        $this->pdoCrud = new PDOCrud;

    }

    public function RecoverCodeUpdate($id,$code)
    { 
        $pdo = array(
            ':id'     => $id,
            ':recoverpasscode' => $code
        );
        
        $values   = "recoverpasscode = :recoverpasscode";
        $clausule = "WHERE id = :id";

        return $this->pdoCrud->update("admin", $values, $clausule, $pdo);
    }

    public function updatePassword($id,$password)
    { 
        
        $pdo = array(
            ':id'       => $id,
            ':password' => SHA1($password)
        );

        $values   = "password = :password";
        $clausule = "WHERE id = :id";

        return $this->pdoCrud->update("admin", $values, $clausule, $pdo);
    }

}