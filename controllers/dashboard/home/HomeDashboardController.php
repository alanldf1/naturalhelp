<?php

/**
 * 
 * Controller do dashboard
 * 
 * @author Emprezaz
 * 
**/

class HomeDashboardController extends Controller{
    public function index()
    {
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
            $this->view('dashboard/home/index.php');
        }else{
            header('LOCATION: '.$this->helpers['URLHelper']->getURL().'/dashboard/login');
        }
    }
}