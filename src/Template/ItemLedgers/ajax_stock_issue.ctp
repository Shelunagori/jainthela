
		<table id="main_table" class="table table-condensed table-bordered">
			<thead>
				<tr align="center">
					<td width="12%">
						<label>Sr<label>
					</td>
					<td width="40%">
						<label>Item<label>
					</td>
					<td width="30%">
						<label>Quantity<label>
					</td>
					<td></td>
				</tr>
			</thead>
			<tbody id='main_tbody' class="tab">
				
			</tbody>
			<tfoot>
				<tr>
					<td>
						<button type="button" class="add btn btn-default input-sm"><i class="fa fa-plus"></i> Add row</button>
					</td>
				</tr>
			</tfoot>
		</table>
		<div class="row" style="padding-top:5px;">
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
			<div class="col-md-4"> </div>
		</div>
		<div align="center">
			<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Create Stock Return'),['class'=>'btn btn-success','id'=>'submitbtn']); ?>
		</div>
		
		<table id="sample_table" style="display:none;">
			<tbody>
				<tr class="main_tr" class="tab">
					<td align="center" width="1px"></td>
				    <td>
						<?= $this->Form->input('item_id',array('options' => $option,'class'=>'form-control input-sm select2me','empty' => 'Select','label'=>false)) ?>
					</td>
					<td>
						<?php echo $this->Form->input('quantity[]', ['label' => false,'class' => 'form-control input-sm number','placeholder'=>'Quantity']); ?>	
					</td>						  
                    <td>
						<a class="btn btn-default delete-tr input-sm" href="#" role="button" style="margin-bottom: 1px;"><i class="fa fa-times"></i></a>
					</td>
				</tr>
			</tbody>
		</table>