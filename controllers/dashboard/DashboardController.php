
<?php

/**
*
* Controller do administrador
*
* @author Code Universe
*
**/
class DashboardController extends Controller
{
    
    public function index()
    {		
        if($this->helpers['AdmSession']->has()){
            $this->setLayout(
                'dashboard/shared/layout.php',
                'Dashboard - Mansão Sugar',
                array(
                    'assets/libs/bootstrap/css/bootstrap.min.css',
                    'assets/libs/fontawesome/css/all.min.css',
                    'assets/css/site/style.css',
                    'assets/css/fonts.css',
                    'assets/css/dashboard/template.css',
                    'assets/css/dashboard/style.css',
                ),
                array(
                    'assets/libs/jquery/jquery.js',
                    'assets/libs/jquery/jquery.mask.min.js',
                    'assets/libs/jquery/jquery.maskMoney.min.js',
                    'assets/js/helpers/helpers.js',
                    'assets/libs/bootstrap/js/bootstrap.bundle.js',
                    'assets/libs/sweetalert/dist/sweetalert2.all.min.js',
                    'assets/libs/bootstrap/js/bootstrap.min.js',
                )
            );
            $this->view('dashboard/home/index.php');
        }else{
            header('LOCATION: '.$this->helpers['URLHelper']->getURL().'/dashboard/login');
        }

    }
}
	