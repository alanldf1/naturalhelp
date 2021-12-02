<?php

$url = $this->helpers['URLHelper']->getURL();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/assets/libs/bootstrap-4.1.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/assets/css/dashboard/dashboard.css">
</head>
<body>

	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
		<a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Time to Help</a>
		<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="<?php echo $url; ?>/logoutAdmin">Sair</a>
			</li>
		</ul>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
				<div class="sidebar-sticky pt-3">
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link active" href="<?php echo $url; ?>/dashboard/home">
								<span data-feather="home"></span>
								Dashboard <span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="<?php echo $url; ?>/dashboard/doador">
								Doador
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="<?php echo $url; ?>/dashboard/recebedor">
								Recebedor
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="<?php echo $url; ?>/dashboard/mensagens">
								Mensagens
							</a>
						</li>
					</ul>
				</div>
			</nav>
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

				<?php require $file;?>

			</main>
		</div>
	</div>

	<script src="<?php echo $url; ?>/assets/libs/jquery/jquery-3.2.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo $url; ?>/assets/libs/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>

</body>
</html>