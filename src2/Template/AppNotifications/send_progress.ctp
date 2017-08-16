	<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense ">
						<i class="fa fa-plus"></i> Sending Message.......
					</span>
				</div>
				</div>
				<div class="portlet-body">
					<div class="progress">
						<div class="progress-bar progress-bar-success" id ="progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="50" style="width: 5%">
							<span  id="per">0% </span>
							</div>
					</div>
						<span class="caption-subject font-purple-intense "><center> Please don't close the page until completed....</center></span>
				</div><div id="result"></div>
				</div>
			</div>	
		</div>			
<input type="hidden" id="id1" value="<?= h($id) ?>">

<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>							
<script>
$( document ).ready(function() {
	convert_csv_data_ajax();
});
function convert_csv_data_ajax(){
		var id=$("#id1").val();
		var url="<?php echo $this->Url->build(['controller'=>'AppNotifications','action'=>'checkNotify']);?>";
		url=url+'/'+id;
	
		$.ajax({
			url: url,
			dataType: 'json'
			}).done(function(response){
				$('#result').html(response);

				if(response.again_call_ajax=="YES"){
					$("#progress").css("width",response.converted_per+"%");
					$("#per").html(response.converted_per+"%");
					convert_csv_data_ajax();
				}
				if(response.again_call_ajax=="NO"){
					$("#progress").css("width",response.converted_per+"%");
					$("#per").html(response.converted_per+"%");							
				}
				});
                
}
</script>

