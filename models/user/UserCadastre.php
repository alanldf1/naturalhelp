<?php

/**
 *
 * Classe que configura o crud de sessão
 *
 * @author Emprezaz.com
 *
 **/
class UserCadastre
{

    private $pdoCrud;
    private $pdoQuery;
    private $userSession;

    public function __construct(){

        $this->pdoCrud     = new PDOCrud;
        $this->pdoQuery    = new PDOQuery;
        $this->userSession = new UserSession;

    }

    public function register($username, $phone, $sex, $preference, $type, $validationCode)
    {
        $pdo = array(
			':username'       => $username,
			':phone'          => $phone,
            ':sex'            => $sex,
            ':preference'     => $preference,
            ':type'           => $type,
            ':validationCode' => $validationCode,
            ':validation'     => false,
		);

		$columns = 'username, phone, sex, preference, type, validationCode, validation';
		$values = ':username, :phone, :sex, :preference, :type, :validationCode, :validation';

        $id = (int) $this->pdoCrud->insert('user', $columns, $values, $pdo);

        $eventName = 'validationUser' . $id;
        // $this->pdoQuery->executeQuery("DELETE FROM mysql.event WHERE name = '" . $eventName . "'");
        $this->pdoQuery->executeQuery("CREATE EVENT $eventName ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 5 MINUTE DO DELETE FROM user WHERE id = '$id' AND validation = 0");

        $this->userSession->saveUser(array(
            'id'             => $id,
            'username'       => $username,
            'phone'          => $phone,
            'sex'            => $sex,
            'search'         => $preference,
            'type'           => $type,
            'validation'     => false
        ));

		return $id;
    }

    public function validationCodeUpdate($id, $validationCode)
    {
        $pdo = array(
            ':validationCode' => $validationCode,
            ':id'             => $id
		);

		$values = 'validationCode = :validationCode';
		$clausule = ' WHERE id = :id';

        return $this->pdoCrud->update('user', $values, $clausule, $pdo);
    }

    public function validate($id, $validation)
    {
        $pdo = array(
            ':id'         => $id,
            ':validation' => $validation
        );

        $values   = "validation = :validation";
        $clausule = "WHERE id = :id";

        return $this->pdoCrud->update("user", $values, $clausule, $pdo);

    }


    public function saveAsaas($id, $idasaas)
    {
   
        $pdo = array(
            ':idasaas' => $idasaas,
        );

        $columns = 'idasaas=:idasaas';

        return $this->pdoCrud->update('user', $columns, 'WHERE id = :id', array_merge($pdo, array(
            ':id' => $id
        )));

    }

    public function saveWalletId($id, $walletId)
    {
        $pdo = array(
            ':walletId' => $walletId,
        );

        $columns = 'walletId = :walletId';

        return $this->pdoCrud->update('user', $columns, 'WHERE id = :id', array_merge($pdo, array(
            ':id' => $id
        )));
    }

    public function updatePassword($id, $password)
    {
        $pdo = array(
            ':id'         => $id,
            ':password'   => SHA1($password),
            ':validation' => true
        );

        $values   = "password = :password, validation = :validation";
        $clausule = "WHERE id = :id";

        return $this->pdoCrud->update("user", $values, $clausule, $pdo);
    }

    function updatePhone($id){
        $previousphone = $this->pdoQuery->fetch("SELECT phone FROM user WHERE id = $id");
        $eventName     = 'validationPhone' . $id;
        $this->pdoQuery->executeQuery("CREATE EVENT $eventName ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 10 MINUTE DO UPDATE user set phone = '$previousphone[phone]'  WHERE id = '$id' AND validation = 0");
    }

    function updateEmailUser(array $user){
        $id = $user['id'];
        $previousemail = $this->pdoQuery->fetch("SELECT email FROM user WHERE id = $id");
        $eventName = 'validationEmail' . $user['id'];
        $this->pdoQuery->executeQuery("DELETE FROM mysql.event WHERE name = '$eventName'");
        $this->pdoQuery->executeQuery("CREATE EVENT $eventName ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 10 MINUTE DO UPDATE user set email = '$previousemail[email]'  WHERE id = '$user[id]' AND validation = 1 AND validateemail = '0'");
    }

    function confirmemail($id){
        $pdo = array(
            ':id'       => $id,
        );
        $values = "validateemail = '1'";
        $clausule = "WHERE id = :id";

        $user = $this->pdoCrud->update("user", $values, $clausule, $pdo);

        return $user;
    }

    public function updateUser(array $data,$validation)
    {   
        if($this->userSession->get('type') == 'daddy'){
            $pdo = array(
                ':id'            => $data['id'],
                ':username'      => $data['username'],
                ':age'           => $data['age'],
                ':bio'           => nl2br($data['bio']),
                ':ufId'          => $data['ufId'],
                ':cityId'        => $data['cityId'],
                ':phone'         => $data['phone'],
                ':email'         => $data['email'],
                ':validateemail' => $validation,
                ':invisible'     => $data['invisible']
            );

            $values = "username = :username, age = :age, bio = :bio, ufId = :ufId, cityId = :cityId, phone = :phone, email = :email,validateemail = :validateemail, invisible = :invisible";
            $clausule = "WHERE id = :id";

            $user = $this->pdoCrud->update("user", $values, $clausule, $pdo);

            if(isset($data['personalinformations_id']) && $user){

                $pdo = array(
                    ':id'                   => $data['personalinformations_id'],
                    ':users_id'             => $data['id'],
                    ':name'                 => $data['name'],
                    ':height'               => $data['height'],
                    ':apresentationPhrase'  => nl2br($data['apresentationPhrase']),
                    ':lookingFor'           => nl2br($data['lookingFor']),
                    ':typeBody'             => $data['typeBody'],
                    ':hairColor'            => $data['hairColor'],
                    ':colorSkin'            => $data['colorSkin'],
                    ':eyeColor'             => $data['eyeColor'],
                    ':smoke'                => $data['smoke'],
                    ':drink'                => $data['drink'],
                    ':maritalStatus'        => $data['maritalStatus'],
                    ':childrens'            => $data['childrens'],
                    ':academicFormation'    => $data['academicFormation'],
                    ':profession'           => $data['profession'],
                    ':likeTrip'             => $data['likeTrip'],
                    ':monthlyIncome'        => $data['monthlyIncome'],
                    ':personalEquity'       => $data['personalEquity']
                );

                $values = "users_id = :users_id, name = :name, height = :height, apresentationPhrase = :apresentationPhrase, lookingFor = :lookingFor, typeBody = :typeBody, hairColor = :hairColor, colorSkin = :colorSkin, eyeColor = :eyeColor, smoke = :smoke, drink = :drink, maritalStatus = :maritalStatus, childrens = :childrens, academicFormation = :academicFormation, profession = :profession, likeTrip = :likeTrip, monthlyIncome = :monthlyIncome, personalEquity = :personalEquity";
                $clausule = "WHERE id = :id";

                return $this->pdoCrud->update("personalinformations", $values, $clausule, $pdo);

            }else if($user){
                $pdo = array(
                    ':users_id'             => $data['id'],
                    ':name'                 => $data['name'],
                    ':height'               => $data['height'],
                    ':apresentationPhrase'  => $data['apresentationPhrase'],
                    ':lookingFor'           => $data['lookingFor'],
                    ':typeBody'             => $data['typeBody'],
                    ':hairColor'            => $data['hairColor'],
                    ':colorSkin'            => $data['colorSkin'],
                    ':eyeColor'             => $data['eyeColor'],
                    ':smoke'                => $data['smoke'],
                    ':drink'                => $data['drink'],
                    ':maritalStatus'        => $data['maritalStatus'],
                    ':childrens'            => $data['childrens'],
                    ':academicFormation'    => $data['academicFormation'],
                    ':profession'           => $data['profession'],
                    ':likeTrip'             => $data['likeTrip'],
                    ':monthlyIncome'        => $data['monthlyIncome'],
                    ':personalEquity'       => $data['personalEquity']
                );

                $columns = "users_id, name, height, apresentationPhrase, lookingFor, typeBody, hairColor, colorSkin, eyeColor, smoke, drink, maritalStatus, childrens, academicFormation, profession, likeTrip, monthlyIncome, personalEquity";
                $values = ":users_id, :name, :height, :apresentationPhrase, :lookingFor, :typeBody, :hairColor, :colorSkin, :eyeColor, :smoke, :drink, :maritalStatus, :childrens, :academicFormation, :profession, :likeTrip, :monthlyIncome, :personalEquity";

                return $this->pdoCrud->insert("personalinformations", $columns, $values, $pdo);
            }

        }else{
            
            $pdo = array(
                ':id'            => $data['id'],
                ':username'      => $data['username'],
                ':age'           => $data['age'],
                ':bio'           => $data['bio'],
                ':ufId'          => $data['ufId'],
                ':cityId'        => $data['cityId'],
                ':phone'         => $data['phone'],
                ':email'         => $data['email'],
                ':validateemail' => $validation,
                ':invisible'     => $data['invisible']
            );

            $values = "username = :username, age = :age, bio = :bio, ufId = :ufId, cityId = :cityId, phone = :phone, email = :email,validateemail = :validateemail, invisible = :invisible";
            $clausule = "WHERE id = :id";

            $user = $this->pdoCrud->update("user", $values, $clausule, $pdo);

            if(isset($data['personalinformations_id']) && $user){

                $pdo = array(
                    ':id'                   => $data['personalinformations_id'],
                    ':users_id'             => $data['id'],
                    ':name'                 => $data['name'],
                    ':height'               => $data['height'],
                    ':apresentationPhrase'  => $data['apresentationPhrase'],
                    ':lookingFor'           => $data['lookingFor'],
                    ':typeBody'             => $data['typeBody'],
                    ':hairColor'            => $data['hairColor'],
                    ':colorSkin'            => $data['colorSkin'],
                    ':eyeColor'             => $data['eyeColor'],
                    ':smoke'                => $data['smoke'],
                    ':drink'                => $data['drink'],
                    ':maritalStatus'        => $data['maritalStatus'],
                    ':childrens'            => $data['childrens'],
                    ':academicFormation'    => $data['academicFormation'],
                    ':profession'           => $data['profession'],
                    ':likeTrip'             => $data['likeTrip']
                );

                $values = "users_id = :users_id, name = :name, height = :height, apresentationPhrase = :apresentationPhrase, lookingFor = :lookingFor, typeBody = :typeBody, hairColor = :hairColor, colorSkin = :colorSkin, eyeColor = :eyeColor, smoke = :smoke, drink = :drink, maritalStatus = :maritalStatus, childrens = :childrens, academicFormation = :academicFormation, profession = :profession, likeTrip = :likeTrip";
                $clausule = "WHERE id = :id";

                return $this->pdoCrud->update("personalinformations", $values, $clausule, $pdo);

            }else if($user){
                $pdo = array(
                    ':users_id'             => $data['id'],
                    ':name'                 => $data['name'],
                    ':height'               => $data['height'],
                    ':apresentationPhrase'  => $data['apresentationPhrase'],
                    ':lookingFor'           => $data['lookingFor'],
                    ':typeBody'             => $data['typeBody'],
                    ':hairColor'            => $data['hairColor'],
                    ':colorSkin'            => $data['colorSkin'],
                    ':eyeColor'             => $data['eyeColor'],
                    ':smoke'                => $data['smoke'],
                    ':drink'                => $data['drink'],
                    ':maritalStatus'        => $data['maritalStatus'],
                    ':childrens'            => $data['childrens'],
                    ':academicFormation'    => $data['academicFormation'],
                    ':profession'           => $data['profession'],
                    ':likeTrip'             => $data['likeTrip']
                );

                $columns = "users_id, name, height, apresentationPhrase, lookingFor, typeBody, hairColor, colorSkin, eyeColor, smoke, drink, maritalStatus, childrens, academicFormation, profession, likeTrip";
                $values = ":users_id, :name, :height, :apresentationPhrase, :lookingFor, :typeBody, :hairColor, :colorSkin, :eyeColor, :smoke, :drink, :maritalStatus, :childrens, :academicFormation, :profession, :likeTrip";

                return $this->pdoCrud->insert("personalinformations", $columns, $values, $pdo);
            }
        }
    }

    public function registerFollow(array $data)
    {
        $pdo = array(
            ':idUser'    => $data['idUser'],
            ':idProfile' => $data['idProfile']
        );

        $columns = 'idUser, idProfile';
		$values = ':idUser, :idProfile';

        return $this->pdoCrud->insert('follows', $columns, $values, $pdo);
    }
    
    public function deleteFollow(array $data)
    {

        return $this->pdoCrud->delete("follows", $data['id']);

    }

    public function updateProfilePhoto($image, $id)
    {
        $pdo = array(
            ':photo'         => $image,
            ':id'            => $id,
        );
        $values = "photo = :photo";
        $clausule = "WHERE id = :id";

        return $this->pdoCrud->update("user", $values, $clausule, $pdo);
    }

    public function savePhotos(array $photos, $userId)
    {

        if ($photos['name'][0]) {

            $id = $userId;

            for ($i = 0; $i < count($photos['name']); $i++) {

                $this->photoControl($id, $photos, $i);
            }

            return true;
        }
    }

    public function photoControl($id, $image, $order)
    {
        $imageName = $image['name'][$order];
        $imageType = $image['type'][$order];
        $imageTmp  = $image['tmp_name'][$order];
       
        if ($imageName != "") {

            $image = $this->ImageConfiguration($imageName, $imageType, $imageTmp, 600, 400, $id);
            
            $this->updateProfilePhoto($image, $id);
        }

        return true;
    }

    private function ImageConfiguration($name, $type, $temp, $width, $height, $id)
    {

        if (preg_match("/^image\/(png)$/", $type)) {

            $formatedImage = imagecreatefrompng($temp);
        } else {

            $formatedImage = imagecreatefromjpeg($temp);
        }

        $originalWidth = imagesx($formatedImage);

        $originalHeigth = imagesy($formatedImage);

        if ($originalWidth > $width) {

            $newWidth  = $width;
        } else {

            $newWidth = $originalWidth;
        }

        $newHeigth = ($originalHeigth * $newWidth) / $originalWidth;

        if ($originalHeigth > $height) {

            $newHeigth  = $height;
        } else {

            $newHeigth = $originalHeigth;
        }

        $newWidth = ($originalWidth * $newHeigth) / $originalHeigth;

        $newImage = imagecreatetruecolor($newWidth, $newHeigth);

        imagecopyresampled($newImage, $formatedImage, 0, 0, 0, 0, $newWidth, $newHeigth, $originalWidth, $originalHeigth);

        return $this->savePhotoFile($name, $newImage, $formatedImage, $type, $id);
    }

    private function savePhotoFile($name, $newImage, $temp, $type, $id)
    {

        $newName = sha1($name);

        if (preg_match("/^image\/(png)$/", $type)) {

            $newName .= '.png';
        } else {

            $newName .= '.jpg';
        }

        if (!file_exists(ROOT . "/assets/img/profile")) {

            mkdir(ROOT . "/assets/img/profile/", 0755, true);
        }

        if (!file_exists(ROOT . "/assets/img/profile/" . $id)) {

            mkdir(ROOT . "/assets/img/profile/" . $id, 0755, true);
        }

        if (!file_exists(ROOT . "/assets/img/profile/" . $id . "/photos")) {

            mkdir(ROOT . "/assets/img/profile/" . $id . "/photos", 0755, true);
        }

        imagejpeg($newImage, ROOT . "/assets/img/profile/" . $id . "/photos/" . $newName, 85);

        imagedestroy($temp);

        imagedestroy($newImage);

        return $newName;

    }
    public function aproveUser($id, $aproveUser)
    {
        $pdo = array(
            ':status' => $aproveUser,
        );

        $columns    = 'status=:status';

        return $this->pdoCrud->update('user', $columns, 'WHERE id = :id', array_merge($pdo, array(
            ':id' => $id,
        )));
    }

    public function reproveUser($id)
    {
        $pdo = array(
            ':status'         => 2,
        );

        $columns    = 'status=:status';

        return $this->pdoCrud->update('userphotos', $columns, 'WHERE id = :id', array_merge($pdo, array(
            ':id' => $id,
        )));
    }

    public function searchFilter($age,$gender, $hairColor, $eyeColor, $childrens, $likeTrip, $maritalStatus, $smoke, $drink, $academicFormation, $profession, $typeBody, $colorSkin, $height, $monthlyIncome, $personalEquity)
    {

        setcookie('hairColor', $hairColor, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('age', $age, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('eyeColor', $eyeColor, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('childrens', $childrens, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('likeTrip', $likeTrip, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('gender', $gender, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('maritalStatus', $maritalStatus, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('smoke', $smoke, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('drink', $drink, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('academicFormation', $academicFormation, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('profession', $profession, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('typeBody', $typeBody, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('colorSkin', $colorSkin, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('height', $height, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('monthlyIncome', $monthlyIncome, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('personalEquity', $personalEquity, time() + (86400 * 30), "/"); // 86400 = 1 day
        return true;
    }

    public function searchBadge($cityId, $new, $highlights, $favorites, $follows, $following)
    {
        
        setcookie('city', $cityId, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('new', $new, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('highlights', $highlights, time() + (86400 * 30), "/");
        setcookie('favorites', $favorites, time() + (86400 * 30), "/");
        setcookie('follows', $follows, time() + (86400 * 30), "/");
        setcookie('following', $following, time() + (86400 * 30), "/");
        return true;
    }
    
}