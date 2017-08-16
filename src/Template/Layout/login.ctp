<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.1
Version: 3.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
	<head>
		<?= $this->Html->charset() ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			<?php echo $title; ?>
		</title>
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
		<?php echo $this->Html->css('/assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/bootstrap/css/bootstrap.min.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/uniform/css/uniform.default.css'); ?>
		<!-- END GLOBAL MANDATORY STYLES -->
		
		<!-- BEGIN PAGE LEVEL STYLES -->
		<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css'); ?>
		<?php echo $this->Html->css('/assets/admin/pages/css/login3.css'); ?>
		<!-- END PAGE LEVEL SCRIPTS -->
		
		<!-- BEGIN THEME STYLES -->
		<?php echo $this->Html->css('/assets/global/css/components.css'); ?>
		<?php echo $this->Html->css('/assets/global/css/plugins.css'); ?>
		<?php echo $this->Html->css('/assets/admin/layout/css/layout.css'); ?>
		<?php echo $this->Html->css('/assets/admin/layout/css/themes/darkblue.css'); ?>
		<?php echo $this->Html->css('/assets/admin/layout/css/custom.css'); ?>
		<!-- END THEME STYLES -->
		<link rel="shortcut icon" href="favicon.ico"/>
	</head>
	<!-- END HEAD -->
	<!-- BEGIN BODY -->
	<body class="login">
		<!-- BEGIN LOGO -->
		<div class="logo">
			<span style="font-size:26px;color:#44b6ae;"><b>Jainthela</b></span>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
		<div class="menu-toggler sidebar-toggler">
		</div>
		<!-- END SIDEBAR TOGGLER BUTTON -->
		<!-- BEGIN LOGIN -->
		<div class="content">
			<?= $this->fetch('content') ?>
		</div>
		<!-- END LOGIN -->
		<!-- BEGIN COPYRIGHT -->
		<div class="copyright">
			2017 © PHP Poets IT Solutions Pvt. Ltd.
		</div>
		<!-- END COPYRIGHT -->
		<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
		<!-- BEGIN CORE PLUGINS -->
		<!--[if lt IE 9]>
		<script src="../../assets/global/plugins/respond.min.js"></script>
		<script src="../../assets/global/plugins/excanvas.min.js"></script> 
		<![endif]-->
		<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/jquery-migrate.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/jquery.blockui.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/uniform/jquery.uniform.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/jquery.cokie.min.js'); ?>
		<!-- END CORE PLUGINS -->
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js'); ?>
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<?php echo $this->Html->script('/assets/global/scripts/metronic.js'); ?>
		<?php echo $this->Html->script('/assets/admin/layout/scripts/layout.js'); ?>
		<?php echo $this->Html->script('/assets/admin/layout/scripts/demo.js'); ?>
		<?php echo $this->Html->script('/assets/admin/pages/scripts/login.js'); ?>
		<!-- END PAGE LEVEL SCRIPTS -->
		<script>
		jQuery(document).ready(function() {     
			Metronic.init(); // init metronic core components
			Layout.init(); // init current layout
			Login.init();
			Demo.init();
		});
		</script>
		<!-- END JAVASCRIPTS -->
	</body>
<!-- END BODY -->
</html>