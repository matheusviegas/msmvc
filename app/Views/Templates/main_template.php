<!doctype html>
<html lang="pt-BR">

<head>
	<title><?=(\App\Core\Helpers\Config::get('title_prefix') . (!empty($title) ? $title : '') . \App\Core\Helpers\Config::get('title_sufix'));?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?=BASE_URL;?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=BASE_URL;?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=BASE_URL;?>assets/vendor/linearicons/style.css">

	<link rel="stylesheet" href="<?=BASE_URL;?>assets/vendor/toastr/toastr.min.css">

	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?=BASE_URL;?>assets/css/main.css">


	<?php foreach($this->getCSS() as $css): ?>
		<link href="<?= $css; ?>" rel="stylesheet" type="text/css" />
	<?php endforeach ?>


	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?=BASE_URL;?>assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?=BASE_URL;?>assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="index.html"><img src="<?=BASE_URL;?>assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger">5</span>
							</a>
							<ul class="dropdown-menu notifications">
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
								<li><a href="#" class="more">See all notifications</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#">Basic Use</a></li>
								<li><a href="#">Working With Data</a></li>
								<li><a href="#">Security</a></li>
								<li><a href="#">Troubleshooting</a></li>
							</ul>
						</li>
						<li class="dropdown">

							<?php
								$loggedUser = \App\Core\Auth::user();
							?>

							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=($loggedUser->picture != null ? BASE_URL . 'uploads/profile_pictures/' . $loggedUser->picture : BASE_URL . 'assets/img/no_picture.png');?>" class="img-circle" alt="Avatar"> <span><?=$loggedUser->name;?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="<?=$this->base('profile'); ?>"><i class="lnr lnr-user"></i> <span>Perfil</span></a></li>
								<li><a href="<?=$this->base('settings'); ?>"><i class="lnr lnr-cog"></i> <span>Configurações</span></a></li>
								<li><a href="<?=$this->base('logout'); ?>"><i class="lnr lnr-exit"></i> <span>Sair</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">

						<?php foreach(\App\Core\Helpers\Config::get('menu_items') as $key => $val): ?>
						<li><a href="<?=$this->base($val['link']); ?>" class="<?=!empty($active_menu_item) && $active_menu_item == $key ? 'active' : '';?>"><i class="lnr lnr-<?=$val['icon'];?>"></i> <span><?=$val['title'];?></span></a></li>
						<?php  endforeach;?>


						
						<!--<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Menu</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="page-profile.html" class="">Item 1</a></li>
									<li><a href="page-login.html" class="">Item 2</a></li>
									<li><a href="page-lockscreen.html" class="">Item 3</a></li>
								</ul>
							</div>
						</li>-->
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel">
						<?php if(!empty($panel_title)) : ?>
							<div class="panel-heading" style="margin-bottom: 10px;">
								<h3 class="panel-title"><?=$panel_title;?></h3>

								<?php if(!empty($action_btn) && !empty($txt_btn)) : ?>
									<span class="pull-right">
								        <a href="<?=$this->base($action_btn);?>" class="btn btn-primary"><?=$txt_btn;?></a>
								    </span>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<div class="panel-body">
							<?php
							 	$this->loadViewInTemplate($viewName, $viewData); 
							?>
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2018 <a href="#" target="_blank">MS MVC</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="<?=BASE_URL;?>assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?=BASE_URL;?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=BASE_URL;?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?=BASE_URL;?>assets/vendor/toastr/toastr.min.js"></script>
	<script src="<?=BASE_URL;?>assets/scripts/klorofil-common.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			var BASE_URL = '<?=BASE_URL;?>';

			<?php if(\App\Core\Helpers\Session::has('flash')): 
				$msg = \App\Core\Helpers\Session::flash('flash');
				foreach($msg as $key => $val):?>
					toastr.options.closeMethod = 'fadeOut';
					toastr.options.closeDuration = 1000;
					toastr.options.closeEasing = 'swing';
					toastr.options.newestOnTop = false;
					toastr.options.timeOut = 5000; 
					toastr.options.extendedTimeOut = 1000;
					toastr.options.progressBar = true;
					toastr.options.closeButton = true;
					toastr['<?=$key;?>']('<?=$val;?>');
			<?php endforeach; endif;?>
		});
	</script>

	<?php foreach($this->getJS() as $js): ?>
		<script src="<?= $js; ?>" type="text/javascript"></script>
	<?php endforeach ?>
</body>

</html>
