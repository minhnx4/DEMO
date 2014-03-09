

<?php echo $this->Form->create('Document',array(
	'inputDefaults' => array(  
		'div' => false,  
		'label' => false,  
		'wrapInput' => false,  
		'class' => 'form-control'  
		),  
	'class' => 'well',
    'url' => array('controller' => 'Document', 'action' => 'edit')
    )); ?>



<?php echo $this->Upload->edit('Document', $this->Form->fields['Document.id']);?>


<?php echo $this->Form->submit('Save', array(  
'div' => false,  
'class' => 'btn btn-default'  
)); ?>  