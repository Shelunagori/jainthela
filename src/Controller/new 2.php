<style media="print">
	.print_hide_order{
		display:none !important;
	}
</style>
<style>
	.img-circle {
	border-radius: 25px;
	}
</style>
<style>
	.img-rounded {
	border-radius: 100px;
	background:#CCC;
	width: 153px;
	height: 153px;   
	}
</style>
<style>
	.img-circle {
	border-radius: 100px;
	width: 40px;
	height: 36px;  
	}
</style>
<style>
	input,select{
		margin:0 !important;
	}
	.er{
	color: rgb(198, 4, 4);
	font-size: 11px;
	}
</style>

            <div class="row">
				<div class="col-md-12">
					<div class="tabbable tabbable-custom tabbable-border">
						<ul class="nav nav-tabs print_hide_order">
							<li class="active">
								<a aria-expanded="true" href="#tab_0" data-toggle="tab">
								Add Item </a>
							</li>
							<li class="active2">
								<a aria-expanded="false" href="#tab_1" data-toggle="tab">
								Edit Item </a>
							</li>
							
							</ul>
						<div class="tab-content">
                   <div align="center"> <?php
                if(!empty($itemalready))
				{
					echo "<div id='success' style='color:blue; padding-bottom:10px;'><p><b>Some Items Already Exist.</b></p></div>";
				}
				?>	</div>
                
                		<div class="tab-pane active" id="tab_0">
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
											<div class="form-body">

                    <form method="post" class="form-horizontal">						
		<div class="portlet-body form">
			<div class="form-body">
				<div class="form-group">
					<label class="control-label col-md-4">Category Name </label>
					<div class="col-md-4">
					 <select class="form-control select2me item_id" placeholder='Select Category' name="item[]" id="item_id">
						<option value=""></option>
						<?php foreach($fetch_master_category_item as $data){ ?>
						<option value="<?php echo $data['master_category_item']['id']; ?>">
						<?php echo $data['master_category_item']['category_name']; ?></option>
						<?php }?>
					</select>
                    <p id="item_idd" class="er"></p>
					</div>
				</div>
				
				
					<table style="width:100%; display:none !important" class="table table-condensed table-bordered" id="parant_table">
                    	<thead>
                        <tr style="background-color:#F3FEF4;">	
							 <th>Item Name</th>
							 <th>Grade </th>
							 <th>Sub Grade & Unit</th>
							 <th>Min. Stock</th>
							  <th>Summary</th>
							   <!--<th>Sub Category</th>-->
							<!-- <th>Related Item</th>
                             <th>Tax</th>-->
							 <th></th>
					    </tr>
                        </thead>
                        <tbody>
					    <tr>
							<td class="master_sub_category">
								<select class="form-control input-small select2me" placeholder='Select Item' name="master_category_item_id[]">
									<option value=""></option>
								</select>
							</td>

							<td>
                            <select class="form-control input-small select2me" placeholder='Select Grade' name="master_grading_item_id[]" id="grading1">
                                                <option value=""></option>
                                                <?php 
                                                foreach($fetch_master_grading_item as $data) 
                                                {
                                                ?>
                                                <option value="<?php echo $data['master_grading_item']['id']; ?>">
                                                <?php echo $data['master_grading_item']['grading']; ?></option>
                                                <?php }?>
                                                </select>
							</td>
							<td>
								<select class="form-control select2me" placeholder='Select Sub Grade' name="master_sub_grading_unit_id[]" id="sub_grading1">
                                                <option value=""></option>
                                                <?php 
                                                foreach($fetch_master_sub_grading_unit as $data) 
                                                {
                                                ?>
                                                <option value="<?php echo $data['master_sub_grading_unit']['id']; ?>">
                                                <?php echo $data['master_sub_grading_unit']['sub_grading_name']; ?>&nbsp;<?php echo $data['master_sub_grading_unit']['unit']; ?></option>
                                                <?php }?>
                                                </select>
							</td>
							
							
							
							
		
							<td>
							<input type="text" name="minimum_stock[]" Placeholder="Stock" class="form-control input-xsmall">
							</td>
							<td align="center"><textarea class="form-control input-medium"  type="text"  id="summary" name="summary[]" value=""></textarea></td>
							<!--<td>
							<select class="form-control select2 input-small related" placeholder='Select Items' multiple name="related_item[]">
				<?php 
				foreach($fetch_master_category_item2 as $category_data)
				{
				$category_name = $category_data['master_category_item']['category_name'];
				$category_id = $category_data['master_category_item']['id'];
				
				
				?>
				<option value="<?php echo $category_id; ?>">
				<?php echo $category_name; ?></option>
				<?php 
				
				} ?>
                       </select>									
							</td>
                            <td>
							<select class="form-control input-small select2me class_tax" placeholder='Select tax' name="item_tax_id[]" id="tax_id1" multiple="multiple">
                                                <option value=""></option>
                                                <?php 
                                                foreach($fetch_master_taxation as $data) 
                                                {
                                                ?>
                                                <option value="<?php echo $data['master_taxation']['id']; ?>">
                                                <?php echo $data['master_taxation']['name']; ?>&nbsp;@<?php echo $data['master_taxation']['tax']; ?></option>
                                                <?php }?>
                                                </select>								
							</td>-->
							<td>
                            <button type="button" onclick="add_row()" class="btn default blue-stripe btn-xs"><i class="fa fa-plus"></i></button>
                            </td>
						</tr>
                        </tbody>
	  	</table>
   
	
		
	
	
	
		</div> 
	
</div>
	<div class="form-actions" style="background-color:#FFF; margin-left:100px">
		<div class="row">
			<div class="col-md-offset-4 col-md-9">
				<button type="submit" class="btn addbtn"  name="master_item_submit"><i class="fa fa-plus"></i> Submit</button>
			</div>
		</div>
	</div>
	</form>
	</div>
</div>
</div>
                                        


		<table id="sample" style="display:none;">
        <tbody>	
			   <tr>
				<td class="master_sub_category">
					<select class="form-control select2me" placeholder='Select Category' name="master_category_item_id[]">
						<option value=""></option>
					</select>
				</td>
				<td>
                            <select class="form-control input-small" placeholder='Select Grade' name="master_grading_item_id[]" id="grading1">
                                                <option value=""></option>
                                                <?php 
                                                foreach($fetch_master_grading_item as $data) 
                                                {
                                                ?>
                                                <option value="<?php echo $data['master_grading_item']['id']; ?>">
                                                <?php echo $data['master_grading_item']['grading']; ?></option>
                                                <?php }?>
                                                </select>
							</td>
							<td>
								<select class="form-control" placeholder='Select Sub Grade' name="master_sub_grading_unit_id[]" id="sub_grading1">
                                                <option value=""></option>
                                                <?php 
                                                foreach($fetch_master_sub_grading_unit as $data) 
                                                {
                                                ?>
                                                <option value="<?php echo $data['master_sub_grading_unit']['id']; ?>">
                                                <?php echo $data['master_sub_grading_unit']['sub_grading_name']; ?>&nbsp;<?php echo $data['master_sub_grading_unit']['unit']; ?></option>
                                                <?php }?>
                                                </select>
							</td>
							<td>
							<input type="text" name="minimum_stock[]" Placeholder="Stock" class="form-control input-xsmall">
							</td>
							 <td align="center"><textarea class="form-control input-medium"  type="text"  id="summary" name="summary[]" value=""></textarea></td>
		
		
							<!--
							<td>
								<select  class="form-control select2 input-small related" placeholder='Select Items' multiple name="related_item[]">
				<?php 
				foreach($fetch_master_category_item2 as $category_data)
				{
				$category_name = $category_data['master_category_item']['category_name'];
				$category_id = $category_data['master_category_item']['id'];
				
				?>
				<option value="<?php echo $category_id; ?>">
				<?php echo $category_name; ?></option>
				<?php 
				
				} ?>
                                </select>									
							</td>
                             <td>
							<select class="form-control input-small select2 class_tax" placeholder='Select tax' name="item_tax_id[]" id="tax_id1" multiple="multiple">
                                                <option value=""></option>
                                                <?php 
                                                foreach($fetch_master_taxation as $data) 
                                                {
                                                ?>
                                                <option value="<?php echo $data['master_taxation']['id']; ?>">
                                                <?php echo $data['master_taxation']['name']; ?>&nbsp;@<?php echo $data['master_taxation']['tax']; ?></option>
                                                <?php }?>
                                                </select>								
							</td>-->
							 <td>
							 <button type="button" onclick="add_row()" class="btn default blue-stripe btn-xs"><i class="fa fa-plus"></i></button>
							<button type="button"  class="btn default red-stripe btn-xs remove_row"><i class="fa fa-trash"></i></button>
							 </td>
	   </tr>
       </tbody> 
	</table>
   
							<div class="tab-pane active2" id="tab_1">
								
									<div class="portlet-body form">
										<!-- BEGIN FORM-->


										
										
											                <div class="row print_hide_order" align="center">
                                    <div class="col-md-12">
                                     <div class="form-group">
									 
									 <div>										
<label class="control-label col-md-1">
<button type="button" id="todayx" class="btn default editbtn" style="background-color:#F93; color:#FFF">Click here for Today Delivery</button>
</label></div><br><br><br>
<div>
<label class="control-label col-md-1">
<button type="button" id="nextx" class="btn default editbtn" style="background-color:#F93; color:#FFF">Click hre for NextDay Delivery</button>
</label></div>
									 <label class="control-label col-md-3"></label>
                                     <label class="control-label col-md-2">Category Name</label>
                    <div class="col-md-2" align="left">
                    <select class="form-control input-small select2 select2me" required placeholder='Select Category' name="category_id" id="category_id_1">
                    <option value=""></option>
                    <?php 
                    foreach($fetch_master_category_item as $data) 
                    {
                    ?>
                    <option value="<?php echo $data['master_category_item']['id']; ?>">
                    <?php echo $data['master_category_item']['category_name']; ?></option>
                    <?php }?>
                    </select>
                    </div>
					
                                                    
                          
<label class="control-label col-md-1">
                            <button type="button" id="ok1" class="btn default addbtn" style="background-color:#F93; color:#FFF">View</button>
</label>
<label class="control-label col-md-1">
                            <button type="button" id="ok2" class="btn default editbtn" style="background-color:#F93; color:#FFF">Update</button>
</label>

                              </div></div></div>
                              <div id="item_view" style="width:100%;">
                              </div></div>
                              </div>
                              
                                                      
<script src="<?php echo $this->webroot; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>


<script>
$(document).ready(function(){
	$('select[name="item[]"]').die().live("change",function(){
		var item=$(this).val();
		$.ajax({
				url: "master_item_ajax?item=" + item,
				success: function(data)   
				{
					$('.master_sub_category').html(data);
					$('#parant_table select').select2();
					$('#parant_table checked').checked();
				}
		});
	});	
});
</script>
<script>
$(document).ready(function(){	
		$("#item_id").on("change",function(){
			item_id= $("#item_id").val();
			if(item_id>0)
			{
				$("#parant_table").show();
			}else{
			$("#parant_table").hide();
		         }
		})
		
	});
</script>
<script>
$(document).ready(function(){	
		$(".remove_row").die().live("click",function(){
			$(this).closest("#parant_table tr").remove();
			var i=0;
			$('#parant_table tbody').find('select.related').each(function(){
				$(this).attr('name','related_item'+i+'[]');
				i++;
			});
			var i=0;
			$('#parant_table tbody').find('select.class_tax').each(function(){
				$(this).attr('name','item_tax_id'+i+'[]');
				i++;
			});
		})
	});
</script>

<script>
function delete_record(value)
{
		$.ajax({
			url: "master_item_delete?idd="+value+"",
			}).done(function(response){
				$("#row"+value).hide();			
			});
}
$(document).ready(function(){
	$("#ok1").die().live("click",function(){
	   var category_id_1=$('#category_id_1').val();
	   
	   
	   if(category_id_1=='')
	   {
	   alert('Please select cateory frist.');
	   }
	   else{
			$.ajax({
			url: "master_item_ajax_view?category_id_1="+category_id_1+"",
			}).done(function(response){
			$("#item_view").html(response);
					
					$('.editable_text').editable({
					url: '/post',
					type: 'text',
					pk: 1
			});	
		}); 
		
		}
	});
	
	$("#ok2").die().live("click",function(){
	   var category_id_1=$('#category_id_1').val();
	   
	   
	   if(category_id_1=='')
	   {
	   alert('Please select cateory frist.');
	   }
	   else{
			$.ajax({
			url: "master_item_edit_ajax?category_id_1="+category_id_1+"",
			}).done(function(response){
			$("#item_view").html(response);
					
					$('.editable_text').editable({
					url: '/post',
					type: 'text',
					pk: 1
			});	
		}); 
		
		}
	});


	$.fn.editable.defaults.mode = 'inline';
	$.fn.editable.defaults.inputclass = 'form-control input-small';
    $.fn.editable.defaults.url = '/post';
	
	$('.editable-submit').live('click', function(e){
		var m_data = new FormData();
		var class_name=$(this).closest('td').find('a.editable_text').length;
		
		var field_name=$(this).closest('td').find('a.editable_text').attr('field_name');
		var value=$(this).closest('form').find('input.form-control').val();
		
		m_data.append(field_name,value);
			var table_id=$(this).closest('td').find('a').attr('table_id');
			m_data.append('edit_plan_id',table_id);
			$.ajax({
			url: "my_ajax?edit_master_item=1",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'json',
			success: function(data)   // A function to be called if request succeeds
			{
				//alert(data);
			}	
		
			});
	});
	
	$("#todayx").die().live("click",function(){
			$.ajax({
			url: "cron_app_list",
			}).done(function(response){
				alert('Delivery changed in today');
			});	
	});
	$("#nextx").die().live("click",function(){
			$.ajax({
			url: "next_day_cron",
			}).done(function(response){
				alert('Delivery changed in Next day');
			});	
	});
	
});
</script>


<script>
	function add_row(){	
		var new_line=$("#sample tbody").html();
			$("#parant_table tbody").append(new_line);
			$('.date-picker').datepicker();
			var i=0;
			$('#parant_table tbody').find('select.related').each(function(){
				$(this).attr('name','related_item'+i+'[]');
				i++;
			});
			var i=0;
			$('#parant_table tbody').find('select.class_tax').each(function(){
				$(this).attr('name','item_tax_id'+i+'[]');
				i++;
			});
			$('#parant_table select').select2();
			$('#parant_table checked').checked();
	}
</script>


<script>
$("form").on("submit",function(e){
	var allow="yes";
	
		$('#parant_table tbody tr select[name="master_category_item_id[]"]').each(function(i, obj) {
			var master_category_item_id=$(this).val();
			if(master_category_item_id==""){
				$(this).closest('td').find(".er").remove();
				$(this).closest('td').append('<p class="er">Required</p>');
				allow="no";
			}else{
				$(this).closest('td').find(".er").remove();
			}
		});
		
		$('#parant_table tbody tr input[name="minimum_stock[]"]').each(function(i, obj) {
			var minimum_stock=$(this).val();
			if(minimum_stock==""){
				$(this).closest('td').find(".er").remove();
				$(this).closest('td').append('<p class="er">Required</p>');
				allow="no";
			}else{
				$(this).closest('td').find(".er").remove();
			}
		});
		$('#parant_table tbody tr select[name="master_grading_item_id[]"]').each(function(i, obj) {
			var master_grading_item_id=$(this).val();
			if(master_grading_item_id==""){
				$(this).closest('td').find(".er").remove();
				$(this).closest('td').append('<p class="er">Required</p>');
				allow="no";
			}else{
				$(this).closest('td').find(".er").remove();
			}
		});
	 
		$('#parant_table tbody tr select[name="master_sub_grading_item_id[]"]').each(function(i, obj) {
			var master_sub_grading_item_id=$(this).val();
			if(master_sub_grading_item_id==""){
				$(this).closest('td').find(".er").remove();
				$(this).closest('td').append('<p class="er">Required</p>');
				allow="no";
			}else{
				$(this).closest('td').find(".er").remove();
			}
		});
	
			var item_id=$("#item_id").val();
			if(item_id==""){
				$("#item_idd").html("Required");
				allow="no";
			}else{
				$("#item_idd").html("");
			}
	if(allow=="no"){
			e.preventDefault();
		}
});	
</script>
<script type="text/javascript">
   $(document).ready(function()
        {
			var myVar=setInterval(function(){myTimerr()},4000);
			function myTimerr() 
	   {
	   $("#success").hide();
	    } 
		
	});
	
	</script>
	
	