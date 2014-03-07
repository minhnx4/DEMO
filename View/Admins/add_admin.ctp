<div class="row">
	<?php echo $this->Session->flash(); ?>
	<div class="col-md-8 col-md-offset-2">  
	  
	<?php echo $this->Form->create('User', array(  
	  'inputDefaults' => array(  
		'div' => false,  
		'label' => false,  
		'wrapInput' => false,  
		'class' => 'form-control'  
	  ),  
	  'class' => 'well'  
	)); ?>
            
	<div class="form-group">
    	<?php echo $this->Form->input('username', array(  
			'placeholder' => 'Username',  
			'style' => 'width:180px;',
			'label' => 'Username',
		)); ?>  
	</div>
	<div class="form-group">
	  <?php echo $this->Form->input('password', array(  
		'placeholder' => 'Password',  
		'style' => 'width:180px;',
		'label' => 'Password'
	  )); ?>  
	</div>

	<div class="form-group">
	  <?php echo $this->Form->input('Admin.email', array(  
		'placeholder' => 'Email',  
		'style' => 'width:180px;',
		'label' => 'Email'
	  )); ?>  
	</div>
            
        <div class="form-group">
	  <?php echo $this->Form->input('Admin.ip_address', array(  
		'placeholder' => 'IP',  
		'style' => 'width:180px;',
		'label' => 'IP'
	  )); ?>  
	</div>

	<?php echo $this->Form->submit('Người dùng', array(  
	'div' => false,  
	'class' => 'btn btn-default'  
	)); ?>  

	<?php echo $this->Form->end(); ?>  
	  
	</div>  
</div>  

