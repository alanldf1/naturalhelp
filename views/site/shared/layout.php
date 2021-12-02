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
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="author" content="Natural Help">
		<title><?php $this->helpers['URLHelper']->getTitle(); ?></title>

		<!-- Styles -->
		<?php $this->helpers['URLHelper']->getStyles(); ?>
		<link rel="shortcut icon" href="<?php echo $url ?>/assets/img/padrao/favicon.png" type="image/x-icon">

	</head>
	<body>
		<header>
			<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
				<a class="navbar-brand" href="#">
					<img src="<?php echo $url; ?>/assets/img/padrao/logo.png" alt="logo NaturalHelp">
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
					<a class="nav-link" href="<?php echo $url; ?>">Início <span class="sr-only">(atual)</span></a>
					</li>

					<li class="nav-item">
					<a class="nav-link" href="<?php echo $url; ?>/quem-somos">Quem Somos</a>
					</li>

					<li class="nav-item">
					<a class="nav-link" href="<?php echo $url; ?>/nos-apoie">Nos Apoie</a>
					</li>

					<li class="nav-item">
					<a class="nav-link" href="<?php echo $url; ?>/doacoes">Doações</a>
					</li>

					<li class="nav-item">
					<a class="nav-link" href="<?php echo $url; ?>/ongs">ONGs</a>
					</li>

					<li class="nav-item">
					<a class="nav-link" href="<?php echo $url; ?>/contato">Contato</a>
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

		<script type="text/javascript">
			var PATH = "<?php echo $url; ?>";
			var Helpers = {};
		</script>

		<!-- Scripts -->
		<?php $this->helpers['URLHelper']->getScripts(); ?>

	</body>
</html>