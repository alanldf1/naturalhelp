<?php
	$url      = $this->helpers['URLHelper']->getURL();
	$location = $this->helpers['URLHelper']->getLocation();
?>

<!DOCTYPE html>
<html lang="pt-BR">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<meta name="author" content="LTR">
		<title><?php $this->helpers['URLHelper']->getTitle(); ?></title>

		<!-- Styles -->
		<?php $this->helpers['URLHelper']->getStyles(); ?>
	<link rel="shortcut icon" href="<?php echo $url ?>/assets/img/padrao/favicon.png" type="image/x-icon">

	</head>

	<body>

		<main>
		<div class="loginAdm" id="content-loginAdm" style="height:100vh;">
			<section class="content h-100">
				<?php require $file; ?>
			</section>
		</div>
		</main>

		<script type="text/javascript">
			var URL = "<?php echo $url; ?>";
			var Helpers = {};
		</script>

		<!-- Scripts -->
		<?php $this->helpers['URLHelper']->getScripts(); ?>

	</body>
	<style>
		@media(max-width:767px){

			footer p{
				font-size: 12px;
			}

			footer .col-md-6,
			footer .socialMedia{
				text-align: center!important;
			}
		}
	</style>

</html>