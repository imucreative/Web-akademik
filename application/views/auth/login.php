<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
	
    <head>
        <title>Login - <?php echo get_data_sekolah('nama_sekolah');?></title>
		<link rel="shortcut icon" href="<?php echo base_url()."uploads/".get_data_sekolah('logo');?>" />
		
        <!-- start: META -->
        <meta charset="utf-8" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="System Akademik <?php echo get_data_sekolah('nama_sekolah');?>" name="description" />
        <meta content="<?php echo get_data_sekolah('nama_sekolah');?>" name="author" />
        <!-- end: META -->
		
        <!-- start: MAIN CSS -->
		<link rel="stylesheet" href="<?php echo base_url();?>template/admin/clip-one/assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>template/admin/clip-one/assets/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>template/admin/clip-one/assets/fonts/style.css">
		<link rel="stylesheet" href="<?php echo base_url();?>template/admin/clip-one/assets/css/main.css">
		<link rel="stylesheet" href="<?php echo base_url();?>template/admin/clip-one/assets/css/main-responsive.css">
		<link rel="stylesheet" href="<?php echo base_url();?>template/admin/clip-one/assets/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="<?php echo base_url();?>template/admin/clip-one/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="<?php echo base_url();?>template/admin/clip-one/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="<?php echo base_url();?>template/admin/clip-one/assets/css/theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?php echo base_url();?>template/admin/clip-one/assets/css/print.css" type="text/css" media="print"/>
        <!--[if IE 7]>
        <link rel="stylesheet" href="http://www.cliptheme.com/preview/admin/clip-one/assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
        <![endif]-->
    </head>
    <!-- end: HEAD -->
	
    <!-- start: BODY -->
    <body class="login example2">
        <div class="main-login col-sm-4 col-sm-offset-4">
            <div class="logo">
				<img width='20%' src='<?php echo base_url()."uploads/".get_data_sekolah('logo');?>'/>
				<?php echo get_data_sekolah('nama_sekolah');?>
			</div>
            <!-- start: LOGIN BOX -->
            <div class="box-login">
                <h4>SYSTEM INFORMASI AKADEMIK</h4>
				<p>Please enter username and password to login.</p>
                <?php echo form_open('auth/chek_login', 'class="form-login"'); ?>
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
					</div>
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" name="username" placeholder="* Username">
								<i class="fa fa-user"></i> 
							</span>
						</div>
						
						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="password" class="form-control password" name="password" placeholder="* Password">
								<i class="fa fa-lock"></i>
								<!--
								<a class="forgot" href="?box=forgot">I forgot my password</a>
								-->
							</span>
						</div>
						
						<div class="new-account">
							<button type="submit" name="submit" class="btn btn-bricky pull-right">Login <i class="fa fa-sign-in"></i></button>
						</div>
					</fieldset>
                </form>
            </div>
            <!-- end: LOGIN BOX -->
			
            <!-- start: FORGOT BOX -->
            <div class="box-forgot">
                <h4>Forget Password?</h4>
                <p>Enter your e-mail address below to reset your password.</p>
                <form class="form-forgot">
                    <div class="errorHandler alert alert-danger no-display">
                        <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
                    </div>
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" name="email" placeholder="* Email">
								<i class="fa fa-envelope"></i>
							</span>
						</div>
						<div class="form-actions">
							<a href="<?php echo base_url();?>auth" class="btn btn-light-grey go-back">
								<i class="fa fa-arrow-circle-left"></i> Back
							</a>
                            <button type="submit" class="btn btn-bricky pull-right">
								Submit <i class="fa fa-arrow-circle-right"></i>
                            </button>
						</div>
                    </fieldset>
                </form>
            </div>
            <!-- end: FORGOT BOX -->
			
            <!-- start: COPYRIGHT -->
            <div class="copyright">
				<?php echo date('Y');?> &copy; <?php echo get_data_sekolah('nama_sekolah');?>.
            </div>
            <!-- end: COPYRIGHT -->
        </div>
		
        <!-- start: MAIN JAVASCRIPTS -->
		
        <!--[if lt IE 9]>
        <script src="http://www.cliptheme.com/preview/admin/clip-one/assets/plugins/respond.min.js"></script>
        <script src="http://www.cliptheme.com/preview/admin/clip-one/assets/plugins/excanvas.min.js"></script>
        <script type="text/javascript" src="http://www.cliptheme.com/preview/admin/clip-one/assets/plugins/jQuery-lib/1.10.2/jquery.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
		
		<script src="<?php echo base_url();?>template/admin/clip-one/assets/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
		<script src="<?php echo base_url();?>template/admin/clip-one/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="<?php echo base_url();?>template/admin/clip-one/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>template/admin/clip-one/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="<?php echo base_url();?>template/admin/clip-one/assets/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="<?php echo base_url();?>template/admin/clip-one/assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="<?php echo base_url();?>template/admin/clip-one/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="<?php echo base_url();?>template/admin/clip-one/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="<?php echo base_url();?>template/admin/clip-one/assets/plugins/less/less-1.5.0.min.js"></script>
		<script src="<?php echo base_url();?>template/admin/clip-one/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="<?php echo base_url();?>template/admin/clip-one/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="<?php echo base_url();?>template/admin/clip-one/assets/js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo base_url();?>template/admin/clip-one/assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="<?php echo base_url();?>template/admin/clip-one/assets/js/login.js"></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        
		<script>
            jQuery(document).ready(function() {
                Main.init();
                Login.init();
            });
        </script>
    </body>
    <!-- end: BODY -->
</html>