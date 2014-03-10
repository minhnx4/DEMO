<?php
class DocumentController extends AppController {
	var $name = "Document";
	var $uses = array('Document');

	public function add() {
		$lesson_id = $this->params['named']['id'];
		$this->set('id', $lesson_id);

		$a['Document']['lesson_id'] = $lesson_id;

		if ($this->request->is('post')) {
		$data = $this->request->data['Document'];

		var_dump($data);

		for($i=0; $i < 3; $i++) 
		{			
			if(is_uploaded_file($data['link'.$i]['tmp_name']))
			{
				$name = $data['link'.$i]['name'];
				move_uploaded_file($data['link'.$i]['tmp_name'], WWW_ROOT."course".DS.$name);					
				$a['Document']['link'] = $name;	
			}

			$this->Document->create();			
			//var_dump('title'.$i);

			$a['Document']['title'] = $data['title'.$i];
			var_dump($data['title'.$i]);
			var_dump($a);
			
			if($this->Document->save($a)){
                $this->Session->setFlash(__('The document has been uploaded'), 'alert', array(
	                'plugin' => 'BoostCake',
	                'class' => 'alert-success'
            	));
            	
				//return $this->redirect(array('controller' => 'test', 'action' => 'add','id'=>$lesson_id));
			} else {
                $this->Session->setFlash(__('The document could not be uploaded. Plz try again'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-warning'
            	));	
			}
		}
	}
	}

	public function upload() {
		
	}

	public function edit() {
		$document_id = $this->params['named']['id'];
	}

	public function delete() {
		$document_id = $this->params['named']['id'];
	}
}
?>