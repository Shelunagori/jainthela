

		
			<div class="row">
			<div class="col-md-3">
			GRN No.
			</div>
			
			<div class="col-md-3">
			<?= $this->Number->format($grn->id) ?>
			</div></div>
			       
    
            <th scope="row"><?= __('Vendor') ?></th>
            <td><?= h($grn->vendor->name)  ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($grn->jain_thela_admin->city->name)?></td>
        </tr>
       
        <tr>
            <th scope="row"><?= __('Grn No') ?></th>
            <td><?= $this->Number->format($grn->grn_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($grn->transaction_date) ?></td>
        </tr>
    </table>
</div>
