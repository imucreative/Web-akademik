<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html class="no-js">
    <!--<![endif]-->

    <head>
        <title><?php echo get_data_sekolah('nama_sekolah');?></title>
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
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Raleway:400,100,200,300,500,600,700,800,900/" />
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/fonts/style.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/css/main.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/css/main-responsive.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/css/theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/css/print.css" type="text/css" media="print"/>
        <!-- end: MAIN CSS -->
		
        <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/DataTables/media/css/DT_bootstrap.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/select2/select2.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/datepicker/css/datepicker.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/jQuery-Tags-Input/jquery.tagsinput.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/summernote/build/summernote.css">
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-modal/css/bootstrap-modal.css" />
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		
		<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
    </head>

    <body class="footer-fixed">

        <!-- start: HEADER -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <!-- start: TOP NAVIGATION CONTAINER -->
            <div class="container">
                <div class="navbar-header">
                    <!-- start: RESPONSIVE MENU TOGGLER -->
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="clip-list-2"></span>
                    </button>
                    <!-- end: RESPONSIVE MENU TOGGLER -->
					
                    <!-- start: LOGO -->
                    <a class="navbar-brand" href="<?php echo base_url();?>welcome">
                        <i class="clip-study"></i>
						<?php echo get_data_sekolah('nama_sekolah');?>
                    </a>
                    <!-- end: LOGO -->
                </div>
                <div class="navbar-tools">
                    <!-- start: TOP NAVIGATION MENU -->
                    <ul class="nav navbar-right">
                        <li>
							<?php
								echo anchor("welcome/profil", "<i class='clip-user-4' aria-hidden='true'></i> ".$this->session->userdata('nama_lengkap'));
							?>
                        </li>
						<li>
                            <?php
								echo anchor("auth/logout", '<i class="fa fa-sign-out" aria-hidden="true"></i> LOGOUT', ["onclick"=>"return confirm('Are you sure?')"]);
							?>
                        </li>
                    </ul>
                    <!-- end: TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- end: TOP NAVIGATION CONTAINER -->
        </div>
        <!-- end: HEADER -->
        <!-- start: MAIN CONTAINER -->
        <div class="main-container">
            <div class="navbar-content">
                <!-- start: SIDEBAR -->
                <div class="main-navigation navbar-collapse collapse">
                    <!-- start: MAIN MENU TOGGLER BUTTON -->
					<!--
                    <div class="navigation-toggler">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>  
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </div>
					-->
                    <!-- end: MAIN MENU TOGGLER BUTTON -->
                    <!-- start: MAIN NAVIGATION MENU -->
                    <ul class="main-navigation-menu">
                        <!-- ini area menu dinamis --->
                        <?php
							$id_level_user	= $this->session->userdata('id_level_user');
							$sql_menu		= "SELECT * FROM tabel_menu WHERE id in(select id_menu from tbl_user_rule where id_level_user=$id_level_user) and is_main_menu=0 AND status_delete='0'";
							$main_menu		= $this->db->query($sql_menu)->result();
							foreach ($main_menu as $main){
								// chek apakah ada submenu ?
								$submenu	= $this->db->get_where('tabel_menu', array('is_main_menu' => $main->id));
								if ($submenu->num_rows() > 0){
									// tampilkan submenu disini
									echo "<li>
										<a href='javascript:void(0)'>
											<i class='".$main->icon."'></i> <span class='title'>".strtoupper($main->nama_menu)."</span>
											<i class='icon-arrow'></i><span class='selected'></span>
										</a>
										<ul class='sub-menu'>";
										foreach ($submenu->result() as $sub) {
											echo "<li>" . anchor($sub->link, "<i class='".$sub->icon."'></i> ".strtoupper($sub->nama_menu))."</li>";
										}
									echo"</ul></li>";
								} else {
									// tampilkan main menu
									echo "<li>" . anchor($main->link, "<i class='".$main->icon."'></i> ".strtoupper($main->nama_menu))."</li>";
								}
							}
                        ?>
                        <li><a href="<?php echo base_url() ?>auth/logout" onclick="return confirm('Are you sure?')"><i class="fa fa-sign-out"></i>LOGOUT</a></li>
						
                    </ul>
                    <!-- end: MAIN NAVIGATION MENU -->
                </div>
                <!-- end: SIDEBAR -->
            </div>

            <!-- start: PAGE -->
            <div class="main-content">
                <!-- start: PANEL CONFIGURATION MODAL FORM -->
                <div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title">Panel Configuration</h4>
                            </div>
                            <div class="modal-body">
                                Here will be a configuration form
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="button" class="btn btn-primary">
                                    Save changes
                                </button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- end: SPANEL CONFIGURATION MODAL FORM -->
                <div class="container">
				
					<!-- start: PAGE HEADER -->
					<div class="row">
						<div class="col-sm-12">
						<!-- start: PAGE TITLE & BREADCRUMB -->
						<!--
							<ol class="breadcrumb">
								<li>
									<i class="fa fa-home" aria-hidden="true"></i>
										<a href="#">Home</a>
								</li>
								<li class="active">
									Dashboard
								</li>
								<li class="search-box">
									<form class="sidebar-search">
										<div class="form-group">
											<input type="text" placeholder="Start Searching..."><button class="submit"><i class="clip-search-3"></i></button>
										</div>
									</form>
								</li>
							</ol>
						-->
							<div class="page-header">
								<h1>
									<?php 
										echo strtoupper($this->uri->segment(1));
									?>
									<small><?php echo strtoupper($this->uri->segment(2));?></small>
								</h1>
							</div>
						<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
						<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<div class="row">
				
						<?php echo $contents; ?>	<!--================================================================================================-->
					
					</div>
                </div>
                <!-- end: PAGE -->
            </div>
            <!-- end: MAIN CONTAINER -->
            <!-- start: FOOTER -->
            <div class="footer clearfix">
                <div class="footer-inner">
                    <script>document.write(new Date().getFullYear())</script> &copy; <?php echo get_data_sekolah('nama_sekolah');?>.
                </div>
                <div class="footer-items">
                    <span class="go-top"><i class="clip-chevron-up"></i></span>
                </div>
            </div>
            <!-- end: FOOTER -->
			
            <!-- start: MAIN JAVASCRIPTS -->
            <!--[if lt IE 9]>
                <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/respond/dest/respond.min.js"></script>
                <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/Flot/excanvas.min.js"></script>
                <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/jquery-1.x/dist/jquery.min.js"></script>
                <![endif]-->
            <!--[if gte IE 9]><!-->

            <!-- end: MAIN JAVASCRIPTS -->
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/blockUI/jquery.blockUI.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/iCheck/jquery.icheck.min.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/less/less-1.5.0.min.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/js/main.js"></script>
			<!-- end: MAIN JAVASCRIPTS -->
			
			<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/autosize/jquery.autosize.min.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/select2/select2.min.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/jquery-maskmoney/jquery.maskMoney.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/js/index.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/jQuery-Tags-Input/jquery.tagsinput.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/summernote/build/summernote.min.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/ckeditor/ckeditor.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/ckeditor/adapters/jquery.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/js/form-elements.js"></script>
			
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/highcharts/highcharts.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/highcharts/modules/exporting.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/highcharts/themes/dark-green.js"></script>
			
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/js/ui-modals.js"></script>

			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
			<script src="<?php echo base_url()?>template/admin/clip-one/assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
			<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

            <script>
                jQuery(document).ready(function() {
                    Main.init();
					FormElements.init();
                });
            </script>

    </body>

</html>