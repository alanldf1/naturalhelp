<?php
/**
 *
 * Controller do site.
 *
 * @author Alan de Souza
 *
 **/
class HomeController extends Controller
{
    public function index(){
        $this->setLayout(
            'site/shared/layout.php',
            'Home - Natural Help',
            array(
                'assets/libs/bootstrap-4.1.3-dist/css/bootstrap.min.css',
                'assets/libs/slick-master/slick/slick.css',
                'assets/libs/slick-master/slick/slick-theme.css',
                'assets/libs/slick-master/slick/custom.css',
                'assets/libs/fontawesome/css/all.min.css',
                'assets/css/font.css',
                'assets/css/site/style.css',
                'assets/css/site/home/home.css',
            ),
            array(
                'assets/libs/jquery/jquery-3.2.1.min.js',
                'assets/libs/bootstrap-4.1.3-dist/js/bootstrap.min.js',
                'assets/libs/slick-master/slick/slick.js',
                'assets/js/site/menu.js',
                'assets/js/site/home/home.js',
            )
        );
        $this->view('site/home/index.php');
    }

}
