<?php //pr($opening_balance_ar);exit;
	if(empty(@$transaction_from_date)){
			$transaction_from_date=" ";
		}else{
			$transaction_from_date=$transaction_from_date;
		} 

		if(empty($transaction_to_date)){
			$transaction_to_date=" ";
		}else{
			$transaction_to_date=$transaction_to_date;
		}

	$opening_balance_ar=[];
	$closing_balance_ar=[];
	if(!empty(@$Ledgers))
	{
		foreach($Ledgers as $Ledger)
		{
			if($Ledger->voucher_source == 'Opening Balance')
			{
				@$opening_balance_ar['debit']+=$Ledger->debit;
				@$opening_balance_ar['credit']+=$Ledger->credit;
				//pr($opening_balance_ar);exit;
			}
			else
			{
				@$opening_balance_total['debit']+=$Ledger->debit;
				@$opening_balance_total['credit']+=$Ledger->credit;			
			}
			@$closing_balance_ar['debit']+=$Ledger->debit;
			@$closing_balance_ar['credit']+=$Ledger->credit;
		}		
	}

	$financialyeardate = (date('m')<'04') ? date('01-04-Y',strtotime('-1 year')) : date('01-04-Y');
?>
<style>
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
	vertical-align: top !important;
}

.drop{
		min-width:80px!important;
		left:-5px;
		padding: 3px 0px;
		box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.3); 
		font-size: 12px;
	}
.dropdown-menu li > a {    padding: 2px 5px; }
.btn1 { padding: 3px 10px; }
</style>
<div class="row">
	<div class="col-md-12">
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Account Statement</span>
		</div>

	<div class="portlet-body form">
	<form method="GET" >
				<table class="table table-condensed" >
				<tbody>
					<tr>
					<td>
						<div class="row">
							<div class="col-md-4">
									<?php echo $this->Form->input('ledger_account_id', ['empty'=>'--Select--','options' => $ledger,'empty' => "--Select Ledger Account--",'label' => false,'class' => 'form-control input-sm select2me','required','value'=>@$ledger_account_id]); ?>
							</div>
							<div class="col-md-4">
								<input type="text" name="From" class="form-control input-sm date-picker From" id="From" placeholder="Transaction From" value="<?php echo @$financialyeardate;  ?>" required data-date-format="dd-mm-yyyy" >
							</div>
							<div class="col-md-4">
								<input type="text" name="To" class="form-control input-sm date-picker To" placeholder="Transaction To"  value="<?php echo @date('d-m-Y', strtotime($transaction_to_date)); ?>" required  data-date-format="dd-mm-yyyy" >
							</div>
							
						</div>
					</td>
					<td><button type="submit" class="btn btn-success btn-sm"><i class="fa fa-filter"></i> Filter</button></td>
					</tr>
				</tbody>
			</table>
	</form>
		<!-- BEGIN FORM-->
<?php if(!empty($Ledger_Account_data)){  ?>
	<div class="row ">
		<div class="col-md-12">
			<div class="col-md-8"></div>	
			<div class="col-md-4 caption-subject " align="left" style="background-color:#E7E2CB; font-size: 16px;"><b>Opening Balance : 
				<?php //pr($opening_balance_ar); exit;
						$opening_balance_data=0;;
						if(!empty(@$opening_balance_ar)){
							if(@$opening_balance_ar['debit'] > @$opening_balance_ar['credit']){
								$opening_balance_data=@$opening_balance_ar['debit'] - @$opening_balance_ar['credit'];
								echo $this->Number->format(@$opening_balance_data.'Dr',[ 'places' => 2]);	echo " Dr";
							}
							else{
								$opening_balance_data=@$opening_balance_ar['credit'] - @$opening_balance_ar['debit'];
								echo $this->Number->format(@$opening_balance_data.'Cr',[ 'places' => 2]); echo " Cr";
							}						
						}
						else { echo $this->Number->format('0',[ 'places' => 2]); }
						$close_dr=0;
						$close_cr=0; 
						if(!empty(@$opening_balance_ar)){  //pr($opening_balance_data); exit;
							if(@$opening_balance_ar['debit'] > @$opening_balance_ar['credit']){
								$close_cr=@$opening_balance_data+@$opening_balance_total['debit'];
								$close_dr=@$opening_balance_total['credit'];
							}
							else if(@$opening_balance_ar['credit'] > @$opening_balance_ar['debit']){ //pr(@$opening_balance_total['credit']);
								$close_cr=@$opening_balance_data+@$opening_balance_total['credit'];
								$close_dr=@$opening_balance_total['debit'];
							}
						}elseif(empty($opening_balance_ar)){
								$close_dr=@$opening_balance_total['debit'];
								$close_cr=@$opening_balance_total['credit'];
								
							}					
				?>  
			</b>
			
			</div>
		</div>
		<div class="col-md-12">
				
		 
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Transaction Date</th>
						<th style="text-align:right;">Dr</th>
						<th style="text-align:right;">Cr</th>
					</tr>
				</thead>
				<tbody>
				<?php  $total_balance_acc=0; $total_debit=0; $total_credit=0;
				foreach($Ledgers as $ledger): 
				if($ledger->voucher_source != 'Opening Balance')	
				{
				?>
				<tr>
						<td><?php echo date("d-m-Y",strtotime($ledger->transaction_date)); ?></td>
						<td align="right"><?= $this->Number->format($ledger->debit,[ 'places' => 2]); 
							$total_debit+=$ledger->debit; ?></td>
						<td align="right"><?= $this->Number->format($ledger->credit,[ 'places' => 2]); 
							$total_credit+=$ledger->credit; ?></td>
				</tr>
				<?php } endforeach; ?>
				<tr>
					<td colspan="1" align="right">Total</td>
					<td align="right" ><?= number_format(@$opening_balance_total['debit'],2,'.',',') ;?> Dr</td>
					<td align="right" ><?= number_format(@$opening_balance_total['credit'],2,'.',',')?> Cr</td>
					
				<tr>
				</tbody>
			</table>
			</div>
			
			<div class="col-md-12">
				<div class="col-md-8"></div>	
				<div class="col-md-4 caption-subject " align="left" style="background-color:#E3F2EE; font-size: 16px;"><b>Closing Balance: </b>
				<?php $closing_balance=@$closing_balance_ar['debit']-@$closing_balance_ar['credit'];
						echo abs($closing_balance);
						if($closing_balance>0){
							echo 'Dr';
						}else if($closing_balance <0){
							echo 'Cr';
						}
						
				?>
				</div>
			</div>
			
		</div>
<?php } ?>
	</div>
</div>	
	</div>
</div>	

<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>


<script>
$(document).ready(function() {
	$('.from_date').datepicker({ 
			todayHighlight: true
	});
	$('.To').datepicker({ 
			todayHighlight: true
	});	
$(".from_date").datepicker({
 format: 'dd-mm-yyyy',
	  autoclose: true,
	}).on('changeDate', function (selected) {
		var startDate = new Date(selected.date.valueOf());
		$('.To').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		$('.To').datepicker('setStartDate', null);
	});

	$(".To").datepicker({
		$('.to_date').datepicker('setStartDate', startDate)
	}).on('clearDate', function (selected) {
		$('.to_date').datepicker('setStartDate', null);
	});

	$(".to_date").datepicker({
	   format: 'dd-mm-yyyy',
	   autoclose: true,
	}).on('changeDate', function (selected) {
	   var endDate = new Date(selected.date.valueOf());
	   $('.From').datepicker('setEndDate', endDate);
	}).on('clearDate', function (selected) {
	   $('.From').datepicker('setEndDate', null);
	});
});
	   $('.from_date').datepicker('setEndDate', endDate);
	}).on('clearDate', function (selected) {
	   $('.from_date').datepicker('setEndDate', null);
	});

});

</script>

