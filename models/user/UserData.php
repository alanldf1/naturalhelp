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

    public function getBlockedsProfileIds($id)
    {
        $blocks = $this->pdoQuery->fetchAll('SELECT u.id FROM user u, blocked b WHERE u.id = b.idProfile AND b.idUser = :id', array(':id' => $id, ));

        foreach($blocks as $block){
            $ids[] = $block['id'];
        }

        return $blocks;
    }

    public function getOldest()
    {
        $data = $this->pdoQuery->fetch('SELECT MAX(age) as maxage FROM user');
        
        return $data['maxage'];
    }

    public function getSearchName($name,$verification)
    {
		 
        $data = $this->pdoQuery->fetchAll('SELECT username, bio, photo, id FROM user WHERE id <>:id AND sex <> :verification AND username like "%'.$name.'%" AND validation = 1', array(':verification' => $verification, ':id' => $this->userSession->get('id') ));
        return $data;
    }
    public function getUsersToAproval()
    {
        $sql = $this->pdoQuery->fetchAll("SELECT u.*, pinfo.name  FROM user u, personalinformations pinfo WHERE pinfo.users_id = u.id AND u.type = 'baby' ORDER BY u.status ASC, u.id DESC");
        
        return $sql;
    }

    public function getMyInformation($id)
    {

        $sql = $this->pdoQuery->fetch("SELECT u.id as userid, p.name,u.cityId, u.ufId, u.age, u.photo, p.*, c.city, uf.uf
            FROM user u, personalinformations p, city c, uf
            WHERE  u.ufId = uf.id and u.cityId = c.id AND p.users_id = u.id AND u.id = :id ", array(
            ':id' => $id
        ));

        return $sql;
    }

    public function getBlocked($username, $id)
    {
        $favorite = $this->pdoQuery->fetch('SELECT * FROM blocked b, user u WHERE b.idProfile = u.id AND u.username = :username AND b.idUser = :id', array(
            ':username' => $username, 
            ':id'       => $id
        ));

        return $favorite;
    }
	public function getInformation($choice, $initial, $total, $boost = false, $black = false, $gold = false, $silver = false, $withoutPlan = false)
    {
        $type = 'baby';

        if ($this->userSession->get('type') == 'baby') {
            $type = 'daddy';
        }

        $boostIf = $boost;

        $boost      = $boostIf ? " inner join boost on boost.userid = u.id AND boost.createdate < NOW() AND boost.dateend > NOW()" : " left outer join boost on boost.userid = u.id AND boost.createdate < NOW() AND boost.dateend > NOW()";
        $plans      = $boostIf ? " pl.name as planname," : " plans.name as planname,";
        $boostWhere = $boostIf ? " " : " AND boost.id IS NULL";

        $black = $black   ? " inner join signature sign on sign.iduser = u.id 
        AND sign.status = 'CONFIRMED'
        AND IF(sign.paymentdate IS NULL, sign.createdate + INTERVAL sign.days DAY > CURDATE(), sign.paymentdate + INTERVAL sign.days DAY > CURDATE())
        inner join plans on plans.id  = sign.idPlan 
        AND lower(plans.name) = 'black'" : "";

        $gold = $gold     ? " inner join signature sign on sign.iduser = u.id
        AND sign.status = 'CONFIRMED'
        AND IF(sign.paymentdate IS NULL, sign.createdate + INTERVAL sign.days DAY > CURDATE(), sign.paymentdate + INTERVAL sign.days DAY > CURDATE())
        inner join plans on plans.id  = sign.idPlan 
        AND lower(plans.name) = 'gold'" : "";

        $silver = $silver ? " inner join signature sign on sign.iduser = u.id
        AND sign.status = 'CONFIRMED'
        AND IF(sign.paymentdate IS NULL, sign.createdate + INTERVAL sign.days DAY > CURDATE(), sign.paymentdate + INTERVAL sign.days DAY > CURDATE())
        inner join plans on plans.id  = sign.idPlan 
        AND lower(plans.name) = 'silver'" : "";

        $withoutPlan = $withoutPlan ? " AND si.id IS NULL" : "";
        $plans       = $withoutPlan ? "" : $plans;

        @$hairColor             = ($_COOKIE['hairColor'] != "") ? ' AND p.hairColor = "' . $_COOKIE['hairColor'] . '"' : "";
        @$age                   = ($_COOKIE['age'] != "") ? ' AND u.age <= "' . $_COOKIE['age'] . '" ' : "";
        @$eyeColor              = ($_COOKIE['eyeColor'] != "") ? ' AND p.eyeColor = "' . $_COOKIE['eyeColor'] . '"' : "";
        @$childrens             = ($_COOKIE['childrens'] != "") ? ' AND p.childrens = "' . $_COOKIE['childrens'] . '"' : "";
        @$likeTrip              = ($_COOKIE['likeTrip'] != "") ? ' AND p.likeTrip = "' . $_COOKIE['likeTrip'] . '"' : "";
        @$gender                = ($_COOKIE['gender'] != "") ? ' AND u.sex = "' . $_COOKIE['gender'] . '"' : "";
        @$typeBody              = ($_COOKIE['typeBody'] != "") ? ' AND p.typeBody = "' . $_COOKIE['typeBody'] . '"' : "";
        @$colorSkin             = ($_COOKIE['colorSkin'] != "") ? ' AND p.colorSkin = "' . $_COOKIE['colorSkin'] . '"' : "";
        @$smoke                 = ($_COOKIE['smoke'] != "") ? ' AND p.smoke = "' . $_COOKIE['smoke'] . '"' : "";
        @$drink                 = ($_COOKIE['drink'] != "") ? ' AND p.drink = "' . $_COOKIE['drink'] . '"' : "";
        @$academicFormation     = ($_COOKIE['academicFormation'] != "") ? ' AND p.academicFormation = "' . $_COOKIE['academicFormation'] . '"' : "";
        @$height                = ($_COOKIE['height'] != "") ? ' AND p.height = "' . $_COOKIE['height'] . '"' : "";
        @$monthlyIncome         = ($_COOKIE['monthlyIncome'] != "") ? ' AND p.monthlyIncome = "'. $_COOKIE['monthlyIncome'] . '"' : "";
        @$personalEquity        = ($_COOKIE['personalEquity'] != "") ? ' AND p.personalEquity = "'.$_COOKIE['personalEquity'] . '"' : "";
        @$profession            = ($_COOKIE['profession'] != "") ? ' AND p.profession = "'. $_COOKIE['profession'] . '"' : "";

        //badges
        @$cityId                = ($_COOKIE['city'] != "") ? ' AND u.cityId = "'. $_COOKIE['city'] . '"' : "";
        @$new                   = ($_COOKIE['new'] != "") ? ', u.id DESC' : "";
        @$highlights            = ($_COOKIE['highlights'] != "" && !$boostIf) ? ' inner join signature si on si.iduser = u.id AND si.status = "CONFIRMED" AND IF(si.paymentdate IS NULL, si.createdate + INTERVAL si.days DAY > CURDATE(), si.paymentdate + INTERVAL si.days DAY > CURDATE()) inner join plans pl on pl.id = si.idPlan' : ' left outer join signature si on si.iduser = u.id AND si.status = "CONFIRMED" AND IF(si.paymentdate IS NULL, si.createdate + INTERVAL si.days DAY > CURDATE(), si.paymentdate + INTERVAL si.days DAY > CURDATE()) left outer join plans pl on pl.id = si.idPlan';
        @$favorites             = ($_COOKIE['favorites'] != "") ? ' inner join favorite fe on fe.profile_id = u.id' : '';
        @$favoritesWhere        = ($_COOKIE['favorites'] != "") ? " AND fe.user_id = '".$this->userSession->get('id')."'" : "";
        @$follows               = ($_COOKIE['follows'] != "") ? " inner join follows f on f.idUser = u.id" : "";
        @$followsWhere          = ($_COOKIE['follows'] != "") ? " AND f.idProfile = '".$this->userSession->get('id')."'" : "";
        @$following             = ($_COOKIE['following'] != "") ? " inner join follows f2 on f2.idProfile = u.id" : "";
        @$followingWhere        = ($_COOKIE['following'] != "") ? " AND f2.idUser = '".$this->userSession->get('id')."'" : "";


        $rand = $initial == 0 || $initial == 1 ? mt_rand(0, 9) * mt_rand(0, 9) : $initial * mt_rand(0, 9);
        if ($choice == 'man') {

            $sql = $this->pdoQuery->fetchAll("SELECT $plans u.id as userid, p.name, u.age, IF(u.photo IS NOT NULL, CONCAT(CONCAT('/assets/img/profile/', u.id), CONCAT('/photos/', u.photo)), '/assets/img/man.jpg') as userphoto, u.username as 'nickname', IF( c.city IS NOT NULL, c.city , NULL) as 'city', IF(uf.initials IS NOT NULL, uf.initials, NULL) as 'uf' FROM user u 
            left outer join personalinformations p on p.users_id = u.id
            ".$boost."
            ".$black."
            ".$gold."
            ".$silver."
            ".$follows."
            ".$following."
            ".$favorites."
            ".$highlights."
            left outer join city c on c.id = u.cityId
            left outer join uf on uf.id = u.ufId
            WHERE u.type = '" . $type . "' 
            AND u.invisible = '0'
            AND u.sex = 'masc' " . 
            $boostWhere.
            $age.
            $withoutPlan.
            $followsWhere .
            $followingWhere .
            $favoritesWhere .
            $hairColor . 
            $eyeColor . 
            $childrens . 
            $likeTrip . 
            $typeBody . 
            $smoke . 
            $drink . 
            $academicFormation . 
            $colorSkin . 
            $height . 
            $monthlyIncome . 
            $personalEquity . 
            $profession . 
            $cityId .
            " GROUP BY u.id 
            ORDER BY CASE WHEN u.photo IS NULL THEN 1 WHEN u.photo IS NOT NULL THEN 0 END, RAND($rand) ".$new."
            LIMIT " . $initial . "," . $total);
        } else if ($choice == 'woman') {

            $sql = $this->pdoQuery->fetchAll("SELECT $plans u.id as userid, p.name, u.age, IF(u.photo IS NOT NULL, CONCAT(CONCAT('/assets/img/profile/', u.id),CONCAT('/photos/', u.photo)), '/assets/img/woman.jpg') as userphoto, u.username as 'nickname', IF( c.city IS NOT NULL, c.city , NULL) as 'city', IF(uf.initials IS NOT NULL, uf.initials, NULL) as 'uf' FROM user u 
            left outer join personalinformations p on p.users_id = u.id
            ".$boost."
            ".$black."
            ".$gold."
            ".$silver."
            ".$follows."
            ".$following."
            ".$favorites."
            ".$highlights."
            left outer join city c on c.id = u.cityId
            left outer join uf on uf.id = u.ufId            
            WHERE u.type = '" . $type . "' 
            AND u.invisible = '0'
            AND u.sex = 'fem' " . 
            $boostWhere.
            $withoutPlan.
            $followsWhere .
            $age.
            $followingWhere .
            $favoritesWhere .
            $hairColor . 
            $eyeColor . 
            $childrens . 
            $likeTrip . 
            $typeBody . 
            $smoke . 
            $drink . 
            $academicFormation . 
            $colorSkin . 
            $height . 
            $monthlyIncome . 
            $personalEquity . 
            $profession . 
            $cityId .
            " GROUP BY u.id
            ORDER BY CASE WHEN u.photo IS NULL THEN 1 WHEN u.photo IS NOT NULL THEN 0 END, RAND($rand) ".$new."
            LIMIT " . $initial . "," . $total);
        } else {
            $sql = $this->pdoQuery->fetchAll("SELECT $plans u.id as userid, p.name, u.age, 
            CASE 
            WHEN u.photo IS NOT NULL THEN CONCAT( CONCAT('/assets/img/profile/', u.id), CONCAT('/photos/', u.photo) ) 
            WHEN u.sex = 'masc' THEN '/assets/img/man.jpg' 
            WHEN u.sex = 'fem' THEN '/assets/img/woman.jpg' 
            ELSE '/assets/img/noprofile.jpg' 
            END as userphoto, u.username as 'nickname', IF( c.city IS NOT NULL, c.city , NULL) as 'city', IF(uf.initials IS NOT NULL, uf.initials, NULL) as 'uf' FROM user u 
            left outer join personalinformations p on p.users_id = u.id
            ".$boost."
            ".$black."
            ".$gold."
            ".$silver."
            ".$follows."
            ".$following."
            ".$favorites."
            ".$highlights."
            left outer join city c on c.id = u.cityId
            left outer join uf on uf.id = u.ufId
            WHERE u.type = '" . $type . "' 
            AND u.invisible = '0' ". 
            $boostWhere.
            $withoutPlan .
            $gender .
            $age.
            $followsWhere .
            $followingWhere .
            $favoritesWhere .
            $hairColor . 
            $eyeColor . 
            $childrens . 
            $likeTrip . 
            $typeBody . 
            $smoke . 
            $drink . 
            $academicFormation . 
            $colorSkin . 
            $height . 
            $monthlyIncome . 
            $personalEquity . 
            $profession . 
            $cityId .
            " GROUP BY u.id 
            ORDER BY CASE WHEN u.photo IS NULL THEN 1 WHEN u.photo IS NOT NULL THEN 0 END, RAND( $rand ) ".$new."
            LIMIT " . $initial . "," . $total);
        }

        return $sql;
    }

	public function getTotalProfile($choice)
    {

        $type = 'baby';

        if ($this->userSession->get('type') == 'baby') {
            $type = 'daddy';
        }

        @$hairColor             = ($_COOKIE['hairColor'] != "") ? ' AND p.hairColor = "' . $_COOKIE['hairColor'] . '"' : "";
        @$age                   = ($_COOKIE['age'] != "") ? ' AND u.age <= "' . $_COOKIE['age'] . '" ' : "";
        @$eyeColor              = ($_COOKIE['eyeColor'] != "") ? ' AND p.eyeColor = "' . $_COOKIE['eyeColor'] . '"' : "";
        @$childrens             = ($_COOKIE['childrens'] != "") ? ' AND p.childrens = "' . $_COOKIE['childrens'] . '"' : "";
        @$likeTrip              = ($_COOKIE['likeTrip'] != "") ? ' AND p.likeTrip = "' . $_COOKIE['likeTrip'] . '"' : "";
        @$gender                = ($_COOKIE['gender'] != "") ? ' AND u.sex = "' . $_COOKIE['gender'] . '"' : "";
        @$typeBody              = ($_COOKIE['typeBody'] != "") ? ' AND p.typeBody = "' . $_COOKIE['typeBody'] . '"' : "";
        @$colorSkin             = ($_COOKIE['colorSkin'] != "") ? ' AND p.colorSkin = "' . $_COOKIE['colorSkin'] . '"' : "";
        @$smoke                 = ($_COOKIE['smoke'] != "") ? ' AND p.smoke = "' . $_COOKIE['smoke'] . '"' : "";
        @$drink                 = ($_COOKIE['drink'] != "") ? ' AND p.drink = "' . $_COOKIE['drink'] . '"' : "";
        @$academicFormation     = ($_COOKIE['academicFormation'] != "") ? ' AND p.academicFormation = "' . $_COOKIE['academicFormation'] . '"' : "";
        @$height                = ($_COOKIE['height'] != "") ? ' AND p.height = "' . $_COOKIE['height'] . '"' : "";
        @$monthlyIncome         = ($_COOKIE['monthlyIncome'] != "") ? ' AND p.monthlyIncome = "'. $_COOKIE['monthlyIncome'] . '"' : "";
        @$personalEquity        = ($_COOKIE['personalEquity'] != "") ? ' AND p.personalEquity = "'.$_COOKIE['personalEquity'] . '"' : "";
        @$profession            = ($_COOKIE['profession'] != "") ? ' AND p.profession = "'. $_COOKIE['profession'] . '"' : "";

        //badges
        @$cityId                = ($_COOKIE['city'] != "") ? ' AND u.cityId = "'. $_COOKIE['city'] . '"' : "";
        @$new                   = ($_COOKIE['new'] != "") ? ', u.id DESC' : "";
        @$highlights            = ($_COOKIE['highlights'] != "" && !$boost) ? ' inner join signature si on si.iduser = u.id AND si.status = "CONFIRMED" AND IF(si.paymentdate IS NULL, si.createdate + INTERVAL si.days DAY > CURDATE(), si.paymentdate + INTERVAL si.days DAY > CURDATE()) inner join plans pl on pl.id = si.idPlan' : ' left outer join signature si on si.iduser = u.id AND si.status = "CONFIRMED" AND IF(si.paymentdate IS NULL, si.createdate + INTERVAL si.days DAY > CURDATE(), si.paymentdate + INTERVAL si.days DAY > CURDATE()) left outer join plans pl on pl.id = si.idPlan';
        @$favorites             = ($_COOKIE['favorites'] != "") ? ' inner join favorite fe on fe.profile_id = u.id' : '';
        @$favoritesWhere        = ($_COOKIE['favorites'] != "") ? " AND fe.user_id = '".$this->userSession->get('id')."'" : "";
        @$follows               = ($_COOKIE['follows'] != "") ? " inner join follows f on f.idUser = u.id" : "";
        @$followsWhere          = ($_COOKIE['follows'] != "") ? " AND f.idProfile = '".$this->userSession->get('id')."'" : "";
        @$following             = ($_COOKIE['following'] != "") ? " inner join follows f2 on f2.idProfile = u.id" : "";
        @$followingWhere        = ($_COOKIE['following'] != "") ? " AND f2.idUser = '".$this->userSession->get('id')."'" : "";

        if ($choice == 'man') {
            $sql = $this->pdoQuery->fetchAll("SELECT u.id as userid, p.name, u.age, u.photo as userphoto, u.username as 'nickname', IF( c.city IS NOT NULL, c.city , NULL) as 'city', IF(uf.initials IS NOT NULL, uf.initials, NULL) as 'uf' FROM user u left outer join personalinformations p on p.users_id = u.id ".$follows." ".$following." ". $favorites ." ".$highlights." left outer join city c on c.id = u.cityId left outer join uf on uf.id = u.ufId WHERE u.type = '" . $type . "' AND u.invisible = 0 AND u.sex = 'masc'".$age . $followsWhere .$followingWhere . $favoritesWhere . $hairColor . $eyeColor . $childrens . $likeTrip . $typeBody . $smoke . $drink . $academicFormation . $colorSkin . $height . $monthlyIncome . $personalEquity . $profession . $cityId ." GROUP BY u.id");
        } else if ($choice == 'woman') {
            $sql = $this->pdoQuery->fetchAll("SELECT u.id as userid, p.name, u.age, u.photo as userphoto, u.username as 'nickname', IF( c.city IS NOT NULL, c.city , NULL) as 'city', IF(uf.initials IS NOT NULL, uf.initials, NULL) as 'uf' FROM user u left outer join personalinformations p on p.users_id = u.id ".$follows." ".$following." ". $favorites ." ".$highlights." left outer join city c on c.id = u.cityId left outer join uf on uf.id = u.ufId WHERE u.type = '" . $type . "' AND u.invisible = 0 AND u.sex = 'fem'". $age . $followsWhere .$followingWhere . $favoritesWhere . $hairColor . $eyeColor . $childrens . $likeTrip . $typeBody . $smoke . $drink . $academicFormation . $colorSkin . $height . $monthlyIncome . $personalEquity . $profession . $cityId." GROUP BY u.id");
        } else {
            $sql = $this->pdoQuery->fetchAll("SELECT u.id as userid, p.name, u.age, u.photo as userphoto, u.username as 'nickname', IF( c.city IS NOT NULL, c.city , NULL) as 'city', IF(uf.initials IS NOT NULL, uf.initials, NULL) as 'uf' FROM user u left outer join personalinformations p on p.users_id = u.id ".$follows." ".$following." ". $favorites ." ".$highlights." left outer join city c on c.id = u.cityId left outer join uf on uf.id = u.ufId WHERE u.type = '" . $type . "' AND u.invisible = 0 ". $age. $gender . $followsWhere .$followingWhere . $favoritesWhere . $hairColor . $eyeColor . $childrens . $likeTrip . $typeBody . $smoke . $drink . $academicFormation . $colorSkin . $height . $monthlyIncome . $personalEquity . $profession . $cityId . " GROUP BY u.id");
        }
        
        return count($sql);
    }

}