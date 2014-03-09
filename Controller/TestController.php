<?php
class TestController extends AppController {
	var $name = 'Test';
	var $uses = array('Test');

	public function add() {
		if ($this->request->is('post')) {	
			
			$data = $this->request->data['Test'];			
			
			if (is_uploaded_file($data['link']['tmp_name'])) {
				$name = $data['link']['name'];
				move_uploaded_file($data['link']['tmp_name'], WWW_ROOT."course/test".DS.$name);
				$this->request->data['Test']['link'] = $name;				
			} 

			$this->Test->create();
			$this->request->data['Test']['lesson_id'] = "10";
			var_dump($this->request->data);

			if($this->Test->save($this->request->data['Test'])){
				return $this->redirect(array('controller' => 'test', 'action' => 'add'));
			} else {
				$this->Session->setFlash("Save data fault !!!");
			}
		}
	}

	public function edit() {

	}

	public function delete() {

	}
}
?>