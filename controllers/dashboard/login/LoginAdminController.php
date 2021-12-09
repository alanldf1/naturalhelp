<?php

/**
 * 
 * Controller do dashboard
 * 
 * @author Emprezaz
 * 
**/

class LoginAdminController extends Controller{

    // Página de login
    public function login(){

		if(!$this->helpers['AdmSession']->has()){
			$this->setLayout(
				'dashboard/login/layout.php',
				'Login Dashboard',
				array(
					'assets/libs/bootstrap/css/bootstrap.min.css',
					'assets/libs/fontawesome/css/all.min.css',
					'assets/css/dashboard/login.css',
				),
				array(
					'assets/libs/jquery/jquery.js',
					'assets/libs/jquery/jquery.mask.min.js',
					'assets/libs/jquery/jquery.maskMoney.min.js',
					'assets/libs/bootstrap/js/bootstrap.min.js',
					'assets/libs/fontawesome/js/all.min.js',
					'assets/libs/sweetalert/dist/sweetalert2.all.min.js',
					'assets/js/dashboard/login.js',
				)
			);
			$this->view('dashboard/login/index.php');
		} else {
			$this->setLayout(
				'dashboard/login/layout.php',
				'Login Dashboard',
				array(
					'assets/libs/bootstrap/css/bootstrap.min.css',
					'assets/libs/fontawesome/css/all.min.css',
					'assets/css/style.css',
					'assets/css/dashboard/login.css',
				),
				array(
					'assets/libs/jquery/jquery.js',
					'assets/libs/jquery/jquery.mask.min.js',
					'assets/libs/jquery/jquery.maskMoney.min.js',
					'assets/libs/bootstrap/js/bootstrap.min.js',
					'assets/libs/fontawesome/js/all.min.js',
					'assets/libs/sweetalert/dist/sweetalert2.all.min.js',
					'assets/js/dashboard/login.js',
				)
			);
			$this->view('dashboard/login/index.php');
		}
	}
	
	// Verificando o username do adm
	public function checkUsernameAdm(){

		$username = addslashes($_POST['username']);

		$check = new DashboardData;
		$check = $check->checkUsernameAdm($username);

		echo json_encode(array(
			'result' => $check,
		));

	}

	// Verificando a senha do adm
	public function checkPasswordAdm(){

		$username = addslashes($_POST['username']);
		$password = addslashes($_POST['password']);

		$check = new DashboardData;
		$check = $check->checkPasswordAdm($username, $password);

		echo json_encode(array(
			'result' => $check,
		));

	}

	// Criando a sessão
	public function saveLogin(){

		$username = addslashes($_POST['username']);

		$getData = new DashboardData;
		$getData = $getData->getData($username);

		if($getData){
			$this->helpers['AdmSession']->save(array(
				'id'		=> $getData['id'],
				'username'	=> $getData['name'],
			));
		}

		echo json_encode(array(
			'result'	=> $getData,
		));

	}

	// Logout adm
	public function logoutAdmin(){

		$this->helpers['AdmSession']->delete();
		header('Location: ' . $this->helpers['URLHelper']->getURL('/dashboard/login'));

	}

}