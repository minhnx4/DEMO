

<?php echo $this->Form->create('Lesson',array(
	'inputDefaults' => array(  
		'div' => false,  
		'label' => false,  
		'wrapInput' => false,  
		'class' => 'form-control'  
		),  
	'class' => 'well',
    'url' => array('controller' => 'Lesson', 'action' => 'edit','id'=>$id)

    )); ?>


<?php echo $this->Upload->view('Document', 5); ?>


<?php echo $this->Form->submit('Save', array(  
'div' => false,  
'class' => 'btn btn-default'  
)); ?>  