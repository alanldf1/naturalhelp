<?php

/**
 *
 * Classe captura os dados do usuário
 *
 * @author Willen
 *
 **/
class UserData
{

	private $pdoQuery;
	private $userSession;

	public function __construct()
	{
		$this->userSession = new UserSession;
		$this->pdoQuery = new PDOQuery;

	}
     public function getAllDonor(){
        return $this->pdoQuery->fetchAll('SELECT * FROM users WHERE type = 2 ');
     }
	public function getData($id)
	{

		return $this->pdoQuery->fetch('SELECT user.*, CASE 
		WHEN user.photo IS NOT NULL THEN CONCAT( CONCAT("/assets/img/profile/", user.id), CONCAT("/photos/", user.photo) ) 
		WHEN user.sex = "masc" THEN "/assets/img/man.jpg" 
		WHEN user.sex = "fem" THEN "/assets/img/woman.jpg" 
		ELSE "/assets/img/noprofile.jpg" 
		END as userphoto, pi.name, pi.hairColor, pi.eyeColor, pi.childrens, pi.likeTrip, pi.maritalStatus, pi.smoke, pi.drink, pi.academicFormation, pi.profession, pi.colorSkin, pi.height, pi.lookingFor, pi.typeBody, pi.monthlyIncome, pi.personalEquity, pi.apresentationPhrase FROM user left join personalinformations pi on pi.users_id = user.id WHERE user.id = :id', array(
			':id' => $id
		));
		
	}

    public function getBlockedsProfile($id)
    {
        $block = $this->pdoQuery->fetchAll('SELECT u.*, CASE 
        WHEN u.photo IS NOT NULL THEN CONCAT( CONCAT("/assets/img/profile/", u.id), CONCAT("/photos/", u.photo) ) 
        WHEN u.sex = "masc" THEN "/assets/img/man.jpg" 
        WHEN u.sex = "fem" THEN "/assets/img/woman.jpg"
        ELSE "/assets/img/noprofile.jpg" 
        END as userphoto FROM user u, blocked b WHERE u.id = b.idProfile AND b.idUser = :id', array(':id' => $id, ));

        return $block;
    }

}