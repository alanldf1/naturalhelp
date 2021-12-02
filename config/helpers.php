<?php

/**
*
* Arquivo onde são definidos os helpers
*
* @author Code Universe
*
**/

define('LOCAL_URL', '/naturalhelp/');

return array(
	'URLHelper' 		=> new URLHelper,
	'AdmSession' 	    => new AdmSession,
	'UserSession' 	    => new UserSession,
	'DateConverter'     => new DateConverter,
);