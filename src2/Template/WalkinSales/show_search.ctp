<table width="50%" class="table table-condensed" id="showdata">
					<tbody>
						<tr>
							<td width="2%">
								<?php echo $this->Form->input('warehouse', ['empty'=>'--Warehouses--','options' => $Warehouses,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Category','value'=> h(@$warehouse_id) ]); ?>
							</td>
							<td width="2%">
								<?php echo $this->Form->input('drivers', ['empty'=>'--Drivers--','options' => $Drivers,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Category','value'=> h(@$drivers_id) ]); ?>
							</td>
							<td width="5%">
							<?php if(!empty($from_date)){ ?>
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo @date('d-m-Y', strtotime($from_date));  ?>"  data-date-format="dd-mm-yyyy">
							<?php }else{ ?>
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo @date('d-m-Y');  ?>"  data-date-format="dd-mm-yyyy">
							<?php } ?>	
							</td>	
							<td width="5%">
							<?php if(!empty($to_date)){ ?>
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To" value="<?php echo @date('d-m-Y', strtotime($to_date));  ?>"  data-date-format="dd-mm-yyyy" >
							<?php }else{ ?>
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To" value="<?php echo @date('d-m-Y');  ?>"  data-date-format="dd-mm-yyyy" >
							<?php } ?>	
							</td>
							<td width="10%">
								<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-filter"></i> Filter</button>
							</td>
							<td width="2%" align="right">
								<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 200px;">
							</td>
						</tr>
					</tbody>
				</table>