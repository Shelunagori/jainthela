<!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
		<meta charset="utf-8"/>
		<?php echo $this->Html->meta(
				'favicon.png',
				'/img/favicon.png',
				['type' => 'icon']
			); ?>
		<title><?= $this->fetch('title') ?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta content="" name="description"/>
		<meta content="" name="author"/>
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
		<?php echo $this->Html->script('/assets/global/plugins/pace/pace.min.js'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/pace/themes/pace-theme-flash.css'); ?>
		<?php //echo $this->Html->css('/assets/global/css/print.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/bootstrap/css/bootstrap.min.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/uniform/css/uniform.default.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css'); ?>
		<!-- END GLOBAL MANDATORY STYLES -->
		<!-- BEGIN PAGE LEVEL STYLES -->
		<?php echo $this->Html->css('/assets/global/plugins/bootstrap-toastr/toastr.min.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css'); ?>
		<!-- BEGIN THEME STYLES -->
		<!-- BEGIN THEME STYLES -->
		<?php echo $this->Html->css('/assets/global/css/components.css'); ?>
		<?php echo $this->Html->css('/assets/global/css/plugins.css'); ?>
		<?php echo $this->Html->css('/assets/admin/layout/css/layout.css'); ?>
		<?php echo $this->Html->css('/assets/admin/layout/css/themes/default.css'); ?>
		<?php echo $this->Html->css('/assets/admin/layout/css/custom.css'); ?>

			<!-- END PAGE LEVEL STYLES -->
		<style media="print">
			.hide_at_print {
				display:none !important;
			}
		</style>
		<style>
			.error-message {
				color: red;
				font-style: inherit;
			}
			.help-block-error{
				color: #a94442;
				font-size: 10px;
			}
		</style>
		<style>
			.self-table > tbody > tr > td, .self-table > tr > td
			{
				border-top:none !important;
			}
			.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
			 
				vertical-align:middle !important;
			}
			option 
			{
				border-top:1px solid #CACACA;
				padding:4px;
				cursor:pointer;
			}
			select 
			{
				cursor:pointer;
			}
			.myshortlogo
			{
				font: 15px "Open Sans",sans-serif;
				text-transform: uppercase !important;
				box-sizing:border-box;
			}
			.toast_success_notify{
				margin: 0px 0px 6px;
				border-radius: 3px;
				background-position: 15px center;
				background-repeat: no-repeat;
				box-shadow: 0px 0px 12px ;
				color: #FFF;
				opacity: 0.8;
				background-color: #42893D;
			}
			.tost_edit_notify{
				margin: 0px 0px 6px;
				border-radius: 3px;
				background-position: 15px center;
				background-repeat: no-repeat;
				box-shadow: 0px 0px 12px #999;
				color: #FFF;
				opacity: 0.8;
				background-color: #B0B343;	
			}
			.tost_delete_notify{
				margin: 0px 0px 6px;
				border-radius: 3px;
				background-position: 15px center;
				background-repeat: no-repeat;
				box-shadow: 0px 0px 12px #999;
				color: #FFF;
				opacity: 0.8;
				background-color: #D75C48;
			}
		</style>
		<!-- END THEME STYLES -->
		<!--<link rel="shortcut icon" href="/img/favicon.png"/>
	</head>
	<!-- END HEAD -->
	<!-- BEGIN BODY -->
	<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
	<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
	<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
	<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
	<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
	<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
	<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
	<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
	<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
	<body class="page-header-fixed page-quick-sidebar-over-content page-style-square">
		<!-- BEGIN HEADER -->
		<div class="page-header navbar navbar-fixed-top">
			<!-- BEGIN HEADER INNER -->
			<div class="page-header-inner">
				<!-- BEGIN LOGO -->
				<div class="page-logo" style="padding-top:2px;padding-bottom:2px; width: auto;">
					<?php echo $this->Html->image('/img/jainthela.png', ['height' => '40px']); ?>
				</div>
				<!-- End LOGO -->
				<div class="hor-menu hidden-sm hidden-xs">
					<ul class="nav navbar-nav " style="margin-left:100px;">
						<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
						
						<li class="classic-menu-dropdown" >
							<a data-toggle="dropdown" href="javascript:;" aria-expanded="false">
							Masters & Setup <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu" >
								<li>
								<?php echo $this->Html->link('<i class="fa fa-user"></i> Customers','/Customers',['escape'=>false]) ?>
								</li>
								
								<li>
									<?php echo $this->Html->link('<i class="fa fa-truck"></i> Drivers','/Drivers/add',['escape'=>false]) ?>
								</li>
								<li>
									<?php echo $this->Html->link('<i class="fa fa-users"></i> Vendors','/Vendors',['escape'=>false]) ?>
								</li>
								<li>
								<?php echo $this->Html->link('<i class="fa fa-magnet"></i> Units','/Units',['escape'=>false]) ?>
								</li>
								<li>
									<?php echo $this->Html->link('<i class="fa fa-sitemap"></i> Item Categories','/Item-Categories',['escape'=>false]) ?>
								</li>
								<li>
									<?php echo $this->Html->link('<i class="fa fa-info"></i> Items','/Items',['escape'=>false]) ?>
								</li>
								<li>
									<?php echo $this->Html->link('<i class="fa fa-cubes"></i> Sales Rate Update','/Items/define_sale_rate',['escape'=>false]) ?>
								</li>
								
							</ul>
						</li>
						<li class="classic-menu-dropdown" >
							<a data-toggle="dropdown" href="javascript:;" aria-expanded="false">
							Reports <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu" >
								<li>
									<?php echo $this->Html->link('<i class="fa  fa-file"></i> Stock Report','/itemLedgers/report_show',['escape'=>false]) ?>
								</li>
								<li>
									<?php echo $this->Html->link('<i class="fa fa-database"></i> Product Report','/itemLedgers/driver_report',['escape'=>false]) ?>
								</li>
								<li>
									<?php echo $this->Html->link('<i class="fa fa-bar-chart-o"></i> Cash Back Details','/CashBacks/Index',['escape'=>false]) ?>
								</li>
								<li>
									<?php echo $this->Html->link('<i class="fa fa-trophy"></i> Cash Back Winner','/CashBacks/CashBackWinner',['escape'=>false]) ?>
								</li>
								<li>
									<?php 
									$t_date = date('d-m-Y');
									echo $this->Html->link('<i class="fa fa-book"></i> Invoice Report','/WalkinSales/invoiceReports?warehouse=&drivers=&From='.$t_date.'&To='.$t_date,['escape'=>false]) ?>
								</li>
								<li>
									<?php echo $this->Html->link('<i class="fa fa-life-ring"></i> Issue Return Report','/ItemLedgers/itemIssueReport',['escape'=>false]) ?>
								</li>
								<!--
								<li>
									<?php echo $this->Html->link('<i class="fa fa-puzzle-piece"></i> Account Statement','/Ledgers/AccountStatements',['escape'=>false]) ?>
								</li>
								-->
								<li>
									<?php echo $this->Html->link('<i class="fa fa-puzzle-piece"></i> Item Wise Sales Report','/itemLedgers/itemSaleReports',['escape'=>false]) ?>
								</li>
								<li>
									<?php echo $this->Html->link('<i class="fa fa-cubes"></i> Driver Location Report','/Drivers/driver_location',['escape'=>false]) ?>
								</li>
								
							</ul>
						</li>
					</ul>
				</div>				 
				<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
				</a>
				<!-- END RESPONSIVE MENU TOGGLER -->
				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">

						<!-- BEGIN NOTIFICATION DROPDOWN -->						 
						<li class="dropdown dropdown-user">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<!--img alt="" class="img-circle" src="../../assets/admin/layout/img/avatar3_small.jpg"/-->
								<span class="username username-hide-on-mobile">
									<?php echo $this->request->session()->read('Config.language'); ?>							
								</span>
								<i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-default">
								<li>									 
									 <?php echo $this->Html->link('<i class="fa fa-key"></i> Log Out', array('controller' => 'Users', 'action' => 'logout'),['escape'=>false]);  ?>
								</li>
							</ul>
						</li>
						<!-- END USER LOGIN DROPDOWN -->						 
					</ul>
				</div>
				<!-- END TOP NAVIGATION MENU -->
			</div>
			<!-- END HEADER INNER -->
		</div>
		<!-- END HEADER -->
		<div class="clearfix">
		</div>
		<!-- BEGIN CONTAINER -->
		<div class="page-container">
				<!-- BEGIN SIDEBAR -->
				<div class="page-sidebar-wrapper">
					<div class="page-sidebar navbar-collapse collapse">
						<!-- BEGIN SIDEBAR MENU -->
						<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
						<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
						<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
						<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
						<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
						<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
						<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">


							<li>
								<?php echo $this->Html->link('<i class="fa fa-dashboard" ></i> <span >Dashboard</span>',array('controller'=>'Orders','action'=>'dashboard'),['escape'=>false]); ?>
							</li>
							<li>
								<?php echo $this->Html->link('<i class="fa fa-reorder"></i> <span>Manage Orders</span>',array('controller'=>'Orders','action'=>'index'),['escape'=>false]); ?>
							</li>
							<li>
								<?php echo $this->Html->link('<i class="fa fa-bell"></i> <span>Push Notification</span>',array('controller'=>'AppNotifications','action'=>'index'),['escape'=>false]); ?>
							</li>
							<li>
								<?php echo $this->Html->link('<i class=" fa-file-text"></i> <span>Feedback</span>',array('controller'=>'Feedbacks'),['escape'=>false]); ?>
							</li>
							<li>
								<?php echo $this->Html->link('<i class="fa fa-chain "></i> <span>Bulk Lead</span>',array('controller'=>'BulkBookingLeads/index/open'),['escape'=>false]); ?>
							</li>


							<li>
								<?php echo $this->Html->link('<i class="fa fa-ticket"></i> GRNs','/Grns',['escape'=>false]) ?>
							</li>
							<li>
								<?php echo $this->Html->link('<i class="fa  fa-book"></i> Purchase Booking','/PurchaseBookings',['escape'=>false]) ?>
							</li>
							<li>
								<?php echo $this->Html->link('<i class="fa fa-puzzle-piece"></i> Transfer Inventory','/TransferInventoryVouchers/',['escape'=>false]) ?>
							</li>

							<li>
								<?php echo $this->Html->link('<i class="fa fa-gear"></i> Purchase Outward','/PurchaseOutwards/',['escape'=>false]) ?>
							</li>
						
							<li>
								<?php echo $this->Html->link('<i class="fa fa-sitemap"></i> Stock Issue','/itemLedgers/add',['escape'=>false]) ?>
							</li>
							<li>
								<?php echo $this->Html->link('<i class="fa fa-retweet"></i> Stock Return','/itemLedgers/stock_return',['escape'=>false]) ?>
							</li>
							<li>
								<?php echo $this->Html->link('<i class="fa fa-asterisk"></i> Online Order','/Orders/add/Offline',['escape'=>false]) ?>
							</li>
							<li>
								<?php echo $this->Html->link('<i class="fa fa-tasks"></i> Bulk Order','/Orders/add/Bulkorder',['escape'=>false]) ?>
							</li>
							<li>
								<?php echo $this->Html->link('<i class="fa fa-file"></i> Walkin Sales','/WalkinSales/add',['escape'=>false]) ?>
							</li>
							<li>
								<?php echo $this->Html->link('<i class="fa fa-tree"></i> Combo Offer','/ComboOffers',['escape'=>false]) ?>
							</li>

							<li>
								<?php echo $this->Html->link('<i class="fa fa-star"></i> Leads','/Leads/index/open',['escape'=>false]) ?>
							</li>

							<li>
								<?php echo $this->Html->link('<i class="fa fa-road"></i> Plans','/Plans',['escape'=>false]) ?>
							</li>
							<li>
								<?php echo $this->Html->link('<i class="fa fa-rocket"></i> Promo Code','/PromoCodes',['escape'=>false]) ?>
							</li>
							
							<li>
								<a href="javascript:;"><i class="fa fa-puzzle-piece"></i><span class="title">Wallets</span>
								<span class="arrow "></span>
								</a>
								<ul class="sub-menu">
									<?php 
									echo '<li>'.$this->Html->link('<i class="icon-home"></i> Add','/Wallets/Add',array('escape'=>false)).'</li>';
									?>
									<?php 
									echo '<li>'.$this->Html->link('<i class="icon-home"></i> Subtract','/Wallets/remove',array('escape'=>false)).'</li>';
									 ?>
								</ul>
							</li>
							
							

						</ul>
						<!-- END SIDEBAR MENU -->
					</div>
				</div>
				<!-- END SIDEBAR -->
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<div  class="page-spinner-bar hide">
						<div class="bounce1"></div>
						<div class="bounce2"></div>
						<div class="bounce3"></div>
					</div>
					<!-- BEGIN PAGE HEADER-->					
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->					 
					<div class="row">
						<div class="col-md-12">
							<div id="toast-container" class="toast-top-right" aria-live="polite" role="alert">
								<?= $this->Flash->render() ?>
							</div>					
							<?php echo $this->fetch('content'); ?>
							<!--here is page content--->
						</div>
					</div>
						<!-- END PAGE CONTENT-->
				</div>
			</div>
			<!-- END CONTENT -->
			<!-- BEGIN QUICK SIDEBAR -->
			<!-- END QUICK SIDEBAR -->
		</div>
		<!-- END CONTAINER -->
		<!-- BEGIN FOOTER -->
		<div class="page-footer">
			<div class="page-footer-inner">
				 <a href="http://phppoets.com/" target="_blank" style="color:#FFF;">2017 &copy; PHPPOETS IT SOLUTION PVT LTD.</a>
			</div>
			<div class="scroll-to-top">
				<i class="icon-arrow-up"></i>
			</div>
		</div>
		<!-- END FOOTER -->
			<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
		
		<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/jquery-migrate.min.js'); ?>
		<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
		<?php echo $this->Html->script('/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/jquery.blockui.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/jquery.cokie.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/uniform/jquery.uniform.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>
		<!-- END CORE PLUGINS -->
		
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'); ?>
		
		<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/additional-methods.min.js'); ?>
		<?php echo $this->Html->script('/assets/admin/pages/scripts/form-validation.js'); ?>
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<?php echo $this->Html->script('/assets/global/scripts/metronic.js'); ?>
		<?php echo $this->Html->script('/assets/admin/layout/scripts/layout.js'); ?>
		<?php echo $this->Html->script('/assets/admin/layout/scripts/quick-sidebar.js'); ?>
		<?php echo $this->Html->script('/assets/admin/layout/scripts/demo.js'); ?>
		<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js'); ?>
		<!-- END PAGE LEVEL SCRIPTS -->
		<script>
		jQuery(document).ready(function() {    
			Metronic.init(); // init metronic core components
			Layout.init(); // init current layout
			QuickSidebar.init(); // init quick sidebar
			Demo.init(); // init demo features
			FormValidation.init();
			ComponentsPickers.init();
			ComponentsDropdowns.init();
			
		});
		</script>	
		<script>
			$("a[role='button']").live('click',function(e){
					e.preventDefault();
			});

			$('a[role="button"]').live('click',function(e){
				e.preventDefault();
			});
			$('.firstupercase').die().live('blur',function(e){
				var str=$(this).val();
				var str2=touppercase(str);
				$(this).val(str2);
			});
			function touppercase(str){
				str = str.replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				});
				return str;
			}
			$(".nospace").live("keypress",function(e){
				 if(e.which === 32) 
				 return false;
			})
			
		</script>         		 
		</div>
		<!-- END JAVASCRIPTS -->
	</body>
	<!-- END BODY -->
</html>