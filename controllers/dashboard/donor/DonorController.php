<?php

/**
 * 
 * Controller do dashboard
 * 
 * @author Emprezaz
 * 
**/

class DonorController extends Controller{
    public function index()
    {
		$donors = new UserData;
		$donors = $donors->GetAllDonor();
        if($this->helpers['AdmSession']->has()){
            $this->setLayout(
                'dashboard/shared/layout.php',
                'Dashboard - Natural Help',
                array(
                    'assets/libs/bootstrap/css/bootstrap.min.css',
                    'assets/libs/fontawesome/css/all.min.css',
                    'assets/css/fonts.css',
                    'assets/css/dashboard/template.css',
                    'assets/css/dashboard/style.css',
                ),
                array(
                    'assets/libs/jquery/jquery-3.2.1.min.js',
                    'assets/libs/bootstrap/js/bootstrap.bundle.min.js',
                    'assets/libs/sweetalert/dist/sweetalert2.all.min.js',
                )
            );
            $this->view('dashboard/donor/index.php', array(
				'donors' => $donors
			));
        }else{
            header('LOCATION: '.$this->helpers['URLHelper']->getURL().'/dashboard/login');
        }
    }
}