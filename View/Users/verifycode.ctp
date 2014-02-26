<div class="row">

<?php echo $this->Session->flash(); ?>
<div class="col-md-8 col-md-offset-2">  
<?php echo $this->Form->create(array(  
  'inputDefaults' => array(  
    'div' => false,  
    'label' => false,  
    'wrapInput' => false,  
    'class' => 'form-control',  
  ),  
  'class' => 'well',  
)); ?>  
  <?php echo $this->Form->input('username', array(  
    'placeholder' => 'Email',  
    'style' => 'width:180px;'
  )); ?>  
  <?php echo $this->Form->input('password', array(  
    'placeholder' => 'Password',  
    'style' => 'width:180px;' 
  )); ?> 
  <div class="form-group">
    <?php echo $this->Form->input('Lecturer.question_verifycode_id', array(    
    'style' => 'width:180px;',
    'label' => 'Question',
    'options' => $droplist,
    )); ?>  
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('Lecturer.current_verifycode', array(  
    'placeholder' => 'Answer',  
    'style' => 'width:180px;',
    'label' => 'Answer'
    )); ?>  
  </div>
  <?php echo $this->Form->submit('Sign in', array(  
    'div' => false,  
    'class' => 'btn btn-default'  
  )); ?>  
<?php echo $this->Form->end(); ?>   
</div>    
</div>  
