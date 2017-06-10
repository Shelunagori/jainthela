<div class="franchises form large-9 medium-8 columns content">
    <?= $this->Form->create($franchise) ?>
    <fieldset>
        <legend><?= __('Add Franchise') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('city_id', ['options' => $cities]);
			 echo $this->Form->control('users[0][username]');
			  echo $this->Form->control('users[0][password]');
			  echo $this->Form->control('users[0][role]',['type'=>'hidden','value'=>'franchise']);
			echo $this->Form->input('item_categories._ids', ['label' => false,'options' => $ItemCategories,'multiple' => 'checkbox']); ?>
			
            
        
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
