<div class="col-md-12">
		
			
				<div class="caption" >
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense ">
						<h4><i class="fa fa-book"></i> Today's Order Summary</h4></span>
				</div>
		
		
		<div class="row">
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
					<div class="dashboard-stat blue-madison">
						<div class="visual">
							<i class="fa fa-comments"></i>
						</div>
					<div class="details">
						<div class="number">
							 
						</div>
						<div class="desc">
							 <h5>Total Order : <?php echo $totalOrder->count;?></h5>
						</div>
						<div class="desc">
							<h5> Total Amount : <?php if($totalOrder->total_amount) { echo '<i class="fa fa-rupee"> </i>' .' '. $totalOrder->total_amount; } else { echo  '0';}?></h5>
						</div>
					</div>
					<?php echo $this->Html->link('<i class="m-icon-swapright m-icon-white"></i> View more','/Orders/index?
					status=yes',array('escape'=>false,'class'=>'more')); ?>
					<!--<a class="more" href="index">
					View more <i class="m-icon-swapright m-icon-white"></i>
					</a>-->
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
							<h5> In Process : <?php echo $inProcessOrder->count;?></h5>
						</div>
						<div class="desc">
							<h5> Total Amount : <?php if($inProcessOrder->total_amount) { echo '<i class="fa fa-rupee"> </i>' .' '.  $inProcessOrder->total_amount; } else { echo  '0';}?></h5>
						</div>
					</div>
					<?php echo $this->Html->link('<i class="m-icon-swapright m-icon-white"></i> View more','/Orders/index?status=process',array('escape'=>false,'class'=>'more')); ?>
					<!--<a class="more" href="index">
					View more <i class="m-icon-swapright m-icon-white"></i>
					</a>-->
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
							<h5> Delivered order : <?php echo $deliveredOrder->count; ?></h5>
						</div>
						<div class="desc">
							<h5> Total Amount : <?php if($deliveredOrder->total_amount) { echo '<i class="fa fa-rupee"> </i>' .' '.   $deliveredOrder->total_amount; } else { echo  '0';}?></h5>
						</div>
					</div>
					<?php echo $this->Html->link('<i class="m-icon-swapright m-icon-white"></i> View more','/Orders/index?
					status=delivered',array('escape'=>false,'class'=>'more')); ?>
					<!--<a class="more" href="index">
					View more <i class="m-icon-swapright m-icon-white"></i>
					</a>-->
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
							 <h5>Cancel order :  <?php echo $cancelOrder->count;?></h5>
						</div>
						<div class="desc">
							<h5> Total Amount : <?php if($cancelOrder->total_amount) { echo '<i class="fa fa-rupee"> </i>' .' '.  $cancelOrder->total_amount; } else { echo  '0';}?></h5>
						
						</div>
					</div>
					<?php echo $this->Html->link('<i class="m-icon-swapright m-icon-white"></i> View more','/Orders/index?
					status=cancel',array('escape'=>false,'class'=>'more')); ?>
					<!--<a class="more" href="index">
					View more <i class="m-icon-swapright m-icon-white"></i>
					</a>-->
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
							<h5> Walkin Sales : <?php echo $walkinsales->count;?></h5>
						</div>
						<div class="desc">
							<h5> Total Amount : <?php if($walkinsales->total_amount) { echo '<i class="fa fa-rupee"> </i>'.' '.  $walkinsales->total_amount; } else { echo  '0';}?></h5>
						</div>
					</div>
					<?php echo $this->Html->link('<i class="m-icon-swapright m-icon-white"></i> View more','/WalkinSales/index?
					status=yes',array('escape'=>false,'class'=>'more')); ?>
					<!--<a class="more" href="../WalkinSales/index">
					View more <i class="m-icon-swapright m-icon-white"></i>
					</a>-->
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
						 <h5>Bulk Booking :  <?php echo $bulkOrder->count;?></h5>
					</div>
					<div class="desc">
						<h5>Total Amount : <?php if($bulkOrder->total_amount) { echo '<i class="fa fa-rupee"> </i>'.' '.  $bulkOrder->total_amount; } else { echo  '0';}?></h5>
						
					</div>
				</div>
				<?php echo $this->Html->link('<i class="m-icon-swapright m-icon-white"></i> View more','/Orders/index?
					type=bulkorder',array('escape'=>false,'class'=>'more')); ?>
				<!--<a class="more" href="index">
				View more <i class="m-icon-swapright m-icon-white"></i>
				</a>-->
			</div>
			</div>
		</div>
			</div>
		</div>
	</div>
</div>
</div>
			