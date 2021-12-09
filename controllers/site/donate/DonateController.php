<?php
/**
 *
 * Controller do site.
 *
 * @author Alan de Souza
 *
 **/
class DonateController extends Controller
{
    public function index(){
        $this->setLayout(
            'site/shared/layout.php',
            'Contribua com essa causa - Natural Help',
            array(
                'assets/libs/bootstrap-4.1.3-dist/css/bootstrap.min.css',
                'assets/libs/fontawesome/css/all.min.css',
                'assets/css/font.css',
                'assets/css/site/style.css',
                'assets/css/site/about/about.css',
            ),
            array(
                'assets/libs/jquery/jquery-3.2.1.min.js',
                'assets/libs/bootstrap-4.1.3-dist/js/bootstrap.min.js',
                'assets/libs/slick-master/slick/slick.js',
                'assets/js/site/menu.js',
            )
        );
        $this->view('site/donate/index.php');
    }

}
