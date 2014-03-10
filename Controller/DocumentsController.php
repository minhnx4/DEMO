<?php

class DocumentsController extends AppController {
  	var $uses = array('User', 'Lecturer','Question','Lesson');	
	public $components = array('Session', 'AjaxMultiUpload.Upload');


	public function edit($value='')
	{
		var_dump($this->request->data);
	}
	public function view($value='')
	{

	}
}

?>
