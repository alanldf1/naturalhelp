<?php

$url = $this->helpers['URLHelper']->getURL();
$params	  = $this->helpers['URLHelper']->getAllParameters();

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php $this->helpers['URLHelper']->getTitle(); ?></title>
	<?php $this->helpers['URLHelper']->getStyles(); ?>
	<link rel="shortcut icon" href="<?php echo $url ?>/assets/img/padrao/favicon.png" type="image/x-icon">
</head>
<body>

	<header class="page-header">
		<div class="expanded row">
			<div class="col-lg-2 logo">
				<img src="<?php echo $url; ?>/assets/img/padrao/text-logo.png">
			</div>
			<!-- navbar right -->
			<div class="col-lg-10 col-md-12 navbar-right text-center" style="background-color: #fff;">
				<div class="toggle-menu bars" data-open-sidebar>
					<i class="fa fa-bars" style="margin-left: 10px;"></i>
				</div>

				<div class="mobile logo">
					<img src="<?php echo $url; ?>/assets/img/padrao/logo.png">
				</div>

				<ul class="nav pull-right">
					<li class="switch-li toggle-sidebar">
						<label class="switch">
							<input type="checkbox" checked>
							<span class="slider round"></span>
						</label>
					</li>

					<li class="divider"></li>

					<li>
						<a href="javascript:void(0)" onclick="location.reload();">
							<i class="fas fa-sync-alt"></i>
						</a>
					</li>

					<li class="hide-fullscreen">
						<a href="javascript:void(0)" data-action="fullscreen">
							<i class="fas fa-expand"></i>
						</a>
					</li>
				</ul>
			</div>

	</header>

	<section id="content">
        <div class="expanded row app-wrap">

            <div class="col-lg-2 col-md-3 c-2">

                <?php require ROOT . '/views/dashboard/shared/menu.php'; ?>

            </div>

            <div class="col-lg-10 col-md-12 page">

                <?php require $file; ?>

            </div>
        </div>
    </section>

    <?php $this->helpers['URLHelper']->getScripts(); ?>
</body>
</html>