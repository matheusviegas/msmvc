<!doctype html>
<html lang="pt-BR" class="fullscreen-bg">

    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <!-- VENDOR CSS -->
        <link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= BASE_URL; ?>assets/vendor/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= BASE_URL; ?>assets/vendor/linearicons/style.css">

        <link rel="stylesheet" href="<?= BASE_URL; ?>assets/vendor/toastr/toastr.min.css">
        <!-- MAIN CSS -->
        <link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/main.css">
        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!-- ICONS -->
        <link rel="apple-touch-icon" sizes="76x76" href="<?= BASE_URL; ?>assets/img/apple-icon.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?= BASE_URL; ?>assets/img/favicon.png">
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
                                    <div class="logo text-center"><img src="<?= BASE_URL; ?>assets/img/logo-dark.png" alt="Klorofil Logo"></div>
                                    <p class="lead"><?= $this->lang->get('title_login_form'); ?></p>
                                </div>
                                <form class="form-auth-small" method="POST" action="<?= $this->base('login/authenticate', TRUE); ?>" autocomplete="off">
                                    <?php $this->csrf_field('login_form'); ?>
                                    <div class="form-group">
                                        <label for="signin-email" class="control-label sr-only"><?= $this->lang->get('label_email'); ?></label>
                                        <input type="email" class="form-control" id="signin-email" value="" name="email" placeholder="<?= $this->lang->get('label_email'); ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="signin-password" class="control-label sr-only"><?= $this->lang->get('label_password'); ?></label>
                                        <input type="password" class="form-control" id="signin-password" value="" name="password" placeholder="<?= $this->lang->get('label_password'); ?>" required />
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-lg btn-block"><?= $this->lang->get('btn_login'); ?></button>
                                    <div class="bottom">
                                        <span class="helper-text"><i class="fa fa-lock"></i> <a href="#"><?= $this->lang->get('label_forgot_password'); ?></a></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>



        <script src="<?= BASE_URL; ?>assets/vendor/jquery/jquery.min.js"></script>
        <script src="<?= BASE_URL; ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= BASE_URL; ?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?= BASE_URL; ?>assets/vendor/toastr/toastr.min.js"></script>
        <script src="<?= BASE_URL; ?>assets/scripts/klorofil-common.js"></script>
        <script src="<?= BASE_URL; ?>assets/js/app.js"></script>

        <?php if (\App\Core\Libraries\Session::has('flash')): ?>
            <script type="text/javascript">
                $(document).ready(function () {
    <?php foreach (\App\Core\Libraries\Session::flash('flash') as $key => $val): ?>
                        toastr['<?= $key; ?>']('<?= $val; ?>');
    <?php endforeach; ?>
                });
            </script>
        <?php endif; ?>
    </body>

</html>
