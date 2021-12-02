<?php

/**
*
* Layout base do site
*
* @author Alan de Souza 
*
**/

$url = $this->helpers['URLHelper']->getURL();

?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title> Natural help - Doações, peça ajuda ou ajude.</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/assets/libs/bootstrap-4.1.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/assets/libs/slick-master/slick/slick.css">
  	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/assets/libs/slick-master/slick/slick-theme.css">
  	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/assets/libs/slick-master/slick/custom.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/assets/css/site/layout.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/assets/css/site/quem-somos.css">
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
	        <a class="navbar-brand" href="#">Time to Help</a>
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
	          <span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse navbar-collapse" id="navbarCollapse">
	          <ul class="navbar-nav ml-auto">
	            <li class="nav-item active">
	              <a class="nav-link" href="<?php echo $url?>">Início <span class="sr-only">(atual)</span></a>
	            </li>

	            <li class="nav-item">
	              <a class="nav-link" href="<?php echo $url?>/quem-somos">Quem Somos</a>
	            </li>

	            <li class="nav-item">
	              <a class="nav-link" href="<?php echo $url?>/nos-apoie">Nos Apoie</a>
	            </li>

	            <li class="nav-item">
	              <a class="nav-link" href="<?php echo $url?>/doacoes">Doações</a>
	            </li>

	            <li class="nav-item">
	              <a class="nav-link" href="<?php echo $url?>/ongs">ONGs</a>
	            </li>

	            <li class="nav-item">
	              <a class="nav-link" href="<?php echo $url?>/contato">Contato</a>
	            </li>
	            
	          </ul>
	        </div>
	    </nav>
	</header>
	<main>
		<?php require $file;?>
	</main>
	<footer class="container">
        <p class="float-right"><a href="#">Voltar ao topo</a></p>
        <p>&copy; Time for Helping, <?php echo date('Y'); ?> &middot; <a href="#">Privacidade</a> &middot; <a href="#">Termos</a></p>
    </footer>

	<script src="<?php echo $url; ?>/assets/libs/jquery/jquery-3.2.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo $url; ?>/assets/libs/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
    <script src="<?php echo $url; ?>/assets/libs/slick-master/slick/slick.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo $url; ?>/assets/js/site/ongs.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo $url; ?>/assets/js/site/doacoes.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo $url; ?>/assets/js/site/contatos.js" type="text/javascript" charset="utf-8"></script>

</body>
</html>