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
	'quem-somos'           	=> 'AboutController/index',
	'nos-apoie'            	=> 'AidController/index',
	'contato'              	=> 'SiteController/contato',
	'doacoes'              	=> 'DonateController/index',
	'ongs'                 	=> 'SiteController/ongs',

	// Rotas da dashboard
	'dashboard'		  		=> 'HomeDashboardController/index',
	'dashboard/login'		=> 'LoginAdminController/login',
	'dashboard/donor'    	=> 'DonorController/index',
	'dashboard/case' 		=> 'ReceiverController/index',
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