<div class="login-box" style="">
	<?php $this->Form->templates([
			'inputContainer' => '{{content}}'
		]); 
			
	?>
	<div class="login-logo">
		
	</div>
   <div class="login-box-body">
   
    <p class="login-box-msg">  
		<?= $this->Form->create() ?>  
		<h3 class="form-title">Login to your account</h3>
        <?= $this->Flash->render() ?>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<?php echo $this->Form->input('username', ['label'=>false,'class' => 'form-control','placeholder'=>'Username']); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<?php echo $this->Form->input('password', ['label'=>false,'class' => 'form-control','placeholder'=>'Password']); ?>
			</div>
		</div>
        
		<div class="form-actions">
			<label class="checkbox">
			<input type="hidden" name="remember" value="1"/> </label>
			<button type="submit" name="login_submit" class="btn green-haze pull-right">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		<?= $this->Form->end() ?>
	</form>
  </div>
</div>
