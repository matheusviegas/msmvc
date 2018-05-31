<!doctype html>
<html lang="pt-BR" class="fullscreen-bg">

<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?=BASE_URL;?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=BASE_URL;?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=BASE_URL;?>assets/vendor/linearicons/style.css">

	<link rel="stylesheet" href="<?=BASE_URL;?>assets/vendor/toastr/toastr.min.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?=BASE_URL;?>assets/css/main.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?=BASE_URL;?>assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?=BASE_URL;?>assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="<?=BASE_URL;?>assets/img/logo-dark.png" alt="Klorofil Logo"></div>
								<p class="lead">Autentique-se</p>
							</div>
							<form class="form-auth-small" method="POST" action="<?=$this->base('login/autenticar', TRUE);?>" autocomplete="off">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input type="email" class="form-control" id="signin-email" value="" name="email" placeholder="Email" required />
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Senha</label>
									<input type="password" class="form-control" id="signin-password" value="" name="senha" placeholder="Senha" required />
								</div>

								<button type="submit" class="btn btn-primary btn-lg btn-block">LOGAR</button>
								<div class="bottom">
									<span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Esqueceu sua senha?</a></span>
								</div>
							</form>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>



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
</body>

</html>
