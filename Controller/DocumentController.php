<?php
class DocumentController extends AppController {
	var $name = "Document";

	public function add() {
		if ($this->request->is('post')) {
		$data = $this->request->data;	

		for($i=0; $i < 20; $i++) {
			
			if (is_uploaded_file($data['link']['tmp_name'])) {
			$name = $data['link']['name'];
			move_uploaded_file($data['link']['tmp_name'], WWW_ROOT."course/test".DS.$name);
			$this->request->data['Test']['link'] = $name;	
			}

			$this->Test->create();
			$this->request->data['Test']['lesson_id'] = "10";
			var_dump($this->request->data);

			if($this->Test->save($this->request->data['Test'])){
			return $this->redirect(array('controller' => 'lecturer', 'action' => 'upload_test'));
				} else {
					$this->Session->setFlash("Save data fault !!!");
				}
			}
		}
	}

	public function edit() {
		$document_id = $this->params['named']['id'];
	}

	public function delete() {
		$document_id = $this->params['named']['id'];
	}
}
?>