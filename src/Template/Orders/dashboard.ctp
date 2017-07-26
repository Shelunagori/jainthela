<div class="col-md-12">
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
				<div class="dashboard-stat blue-madison">
					<div class="visual">
						<i class="fa fa-comments"></i>
					</div>
					<div class="details">
						<div class="number">
							 
						</div>
						<div class="desc">
							 Total Order : <?php echo $totalOrder->count;?>
						</div>
						<div class="desc">
							 Total Amount : <?php if($totalOrder->total_amount) { echo $totalOrder->total_amount; } else { echo  '0';}?>
						</div>
					</div>
					<a class="more" href="index">
					View more <i class="m-icon-swapright m-icon-white"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
				<div class="dashboard-stat red-intense">
					<div class="visual">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="details">
						<div class="number">
							  
						</div>
						<div class="desc">
							 In Process : <?php echo $inProcessOrder->count;?>
						</div>
						<div class="desc">
							 Total Amount : <?php if($inProcessOrder->total_amount) { echo $inProcessOrder->total_amount; } else { echo  '0';}?>
						</div>
					</div>
					<a class="more" href="index">
					View more <i class="m-icon-swapright m-icon-white"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
				<div class="dashboard-stat green-haze">
					<div class="visual">
						<i class="fa fa-shopping-cart"></i>
					</div>
					<div class="details">
						<div class="number">
							 
						</div>
						<div class="desc">
							 Delivered order : <?php echo $deliveredOrder->count; ?>
						</div>
						<div class="desc">
							 Total Amount : <?php if($deliveredOrder->total_amount) { echo $deliveredOrder->total_amount; } else { echo  '0';}?>
						</div>
					</div>
					<a class="more" href="index">
					View more <i class="m-icon-swapright m-icon-white"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
				<div class="dashboard-stat purple-plum">
					<div class="visual">
						<i class="fa fa-globe"></i>
					</div>
					<div class="details">
						<div class="number">
							 
						</div>
						<div class="desc">
							 Cancel order :  <?php echo $cancelOrder->count;?>
						</div>
						<div class="desc">
							 Total Amount : <?php if($cancelOrder->total_amount) { echo $cancelOrder->total_amount; } else { echo  '0';}?>
						
						</div>
					</div>
					<a class="more" href="index">
					View more <i class="m-icon-swapright m-icon-white"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
				<div class="dashboard-stat blue-madison">
					<div class="visual">
						<i class="fa fa-comments"></i>
					</div>
					<div class="details">
						<div class="number">
							  
						</div>
						<div class="desc">
							 Walkin Sales : <?php echo $walkinsales->count;?>
						</div>
						<div class="desc">
							  Total Amount : <?php if($walkinsales->total_amount) { echo $walkinsales->total_amount; } else { echo  '0';}?>
						</div>
					</div>
					<a class="more" href="../WalkinSales/index">
					View more <i class="m-icon-swapright m-icon-white"></i>
					</a>
				</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
			<div class="dashboard-stat red-intense">
				<div class="visual">
					<i class="fa fa-bar-chart-o"></i>
				</div>
				<div class="details">
					<div class="number">
						 
					</div>
					<div class="desc">
						 Bulk Booking :  <?php echo $bulkOrder->count;?>
					</div>
					<div class="desc">
						Total Amount : <?php if($bulkOrder->total_amount) { echo $bulkOrder->total_amount; } else { echo  '0';}?>
						
					</div>
				</div>
				<a class="more" href="index">
				View more <i class="m-icon-swapright m-icon-white"></i>
				</a>
			</div>
		</div>
	</div>
</div>
			
		