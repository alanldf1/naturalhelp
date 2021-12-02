<?php

/**
*
* Definição das rotas e seus respectivos controllers e actions
*
* @author Code Universe
*
**/

$commonRoutes = array(
	'/'                    	=> 'HomeController/index',
	'quem-somos'           	=> 'SiteController/quemSomos',
	'nos-apoie'            	=> 'AidController/index',
	'contato'              	=> 'SiteController/contato',
	'doacoes'              	=> 'SiteController/doacoes',
	'ongs'                 	=> 'SiteController/ongs',

	// Rotas da dashboard
	'dashboard'				=> 'DashboardController/index',
	'dashboard/login'		=> 'LoginAdminController/login',
	'dashboard/doador'    	=> 'DonaterController/index',
	'dashboard/recebedor' 	=> 'ReceiverController/index',
	'dashboard/mensagens' 	=> 'MessagesController/index',
);

// rotas POST
$commonPost = array(
	'cadastro' => 'SiteController/cadastro',
	'mensagem' => 'SiteController/mensagem',

	// login dashboard
	'checkUsernameAdm'			=> 'LoginAdminController/checkUsernameAdm',
	'checkEmailAdm'				=> 'LoginAdminController/checkEmailAdm',
	'checkPasswordAdm'			=> 'LoginAdminController/checkPasswordAdm',
	'saveLogin'					=> 'LoginAdminController/saveLogin',
	'logoutAdmin'				=> 'LoginAdminController/logoutAdmin',
);


$commonRoutes = array_merge($commonRoutes, $commonPost);

return $commonRoutes;