<?php

/**
*
* Layout base do site
*
* @author Alan de Souza 
*
**/
	$url = $this->helpers['URLHelper']->getURL();
	$location = $this->helpers['URLHelper']->getLocation();
?> 

<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<meta name="author" content="Natural Help">
		<title><?php $this->helpers['URLHelper']->getTitle(); ?></title>

		<!-- Styles -->
		<?php $this->helpers['URLHelper']->getStyles(); ?>
		<link rel="shortcut icon" href="<?php echo $url ?>/assets/img/padrao/favicon.png" type="image/x-icon">

	</head>
	<body>
		<header>
			<nav>
				<a class="logo" href="<?=$url?>/">
					<img src="<?php echo $url; ?>/assets/img/padrao/text-logo.png" alt="logo NaturalHelp">
				</a>
				<div class="menu-mobile">
					<div class="menu">
						<i id="menu" class="fas fa-bars"></i>
					</div>
					
					<div class="menu-collapse hidden dark-blue font-black" id="menuCollapse">
						<h2>MENU</h2>
						<i class="fas fa-times-circle light-green" id="close-menu"></i>
						<a href="<?=$url?>">
							<i class="fas fa-home light-green"></i>
							Início
						</a>
						<a href="<?=$url?>/quem-somos">
							<i class="fas fa-book light-green"></i>
							Quem Somos	
						</a>
						<a href="<?=$url?>/nos-apoie">
							<i class="fas fa-hands-helping light-green"></i>
							Nos Apoie
						</a>
						<a href="<?=$url?>/doacoes">
							<i class="fas fa-donate light-green"></i>
							Doações
						</a>
						<a href="<?=$url?>/ongs">
							<i class="fas fa-copyright light-green"></i>
							ONGs
						</a>
						<a href="<?=$url?>/contato">
							<i class="fas fa-phone light-green"></i>
							Contato
						</a>
					</div>
				</div>
				<div class="menu-desktop">
					<a href="<?=$url?>/quem-somos" class="dark-blue">
						Quem Somos	
					</a>
					<a href="<?=$url?>/doacoes" class="dark-blue">
						Contribua
					</a>
					<a href="<?=$url?>/ongs" class="dark-blue">
						ONGs
					</a>
					<a href="<?=$url?>/nos-apoie" class="dark-blue">
						Nos Apoie
					</a>
					<a href="<?=$url?>/contato" class="dark-blue">
						Contato
					</a>
				</div>
			</nav>
		</header>
		<main>
			<?php require $file;?>
		</main>
		<footer>
			<div class="social-media">
				<h3>Nos siga nas redes sociais:</h3> 
				<h2>
					<a href="">
						<i class="fab fa-facebook-f"></i>
					</a>	
					<a href="">
						<i class="fab fa-instagram"></i>
					</a>				
					<a href="">
						<i class="fab fa-whatsapp"></i>
					</a>
				</h2>
			</div>
			<div class="pages">
				<h2>Páginas</h2>
				<a href="<?=$url?>/quem-somos" class="dark-blue">
					Quem Somos	
				</a>
				<a href="<?=$url?>/doacoes" class="dark-blue">
					Contribua
				</a>
				<a href="<?=$url?>/ongs" class="dark-blue">
					ONGs
				</a>
				<a href="<?=$url?>/nos-apoie" class="dark-blue">
					Nos Apoie
				</a>
				<a href="<?=$url?>/contato" class="dark-blue">
					Contato
				</a>
			</div>
			<div class="policy text-center">
			<p>&copy; Natural Help, 2021 &middot; <a href="#">Privacidade</a> &middot; <a href="#">Termos</a></p>

			</div>
		</footer>

		<script type="text/javascript">
			var PATH = "<?php echo $url; ?>";
			var Helpers = {};
		</script>

		<!-- Scripts -->
		<?php $this->helpers['URLHelper']->getScripts(); ?>

	</body>
</html>