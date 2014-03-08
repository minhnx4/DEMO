<?php 
class LessonController extends AppController {
	var $name = "Lesson";
  	var $uses = array('User', 'Lecturer','Question','Lesson','Tag');	
  	public function beforeFilter() {
        parent::beforeFilter();
    }
    public function add($value='')
    {
    	if($this->request->is('post')){
	    	$data = ($this->request->data);
			echo "<pre>";
			var_dump($data);
	    	$data['Lesson']['lecturer_id'] = $this->Auth->user('id');

	    	$rawtags = explode(",",$data["hidden-data"]['Tag']['name']);

	    	$tags = array();
	    	foreach ($rawtags as $key => $value) {
	    		var_dump($value);
		    	$tag = $this->Tag->findByName($value);
		    	if (!$tag) {
		    		$this->Tag->create();
		    		$this->Tag->set("name",$value);
		    		$tag = $this->Tag->save();
		    	}
	    		array_push($tags, $tag['Tag']['id']);
	    	}
	    	$data['Tag'] = $tags;
			$this->Lesson->create();
			if($this->Lesson->saveAll($data)){
				$this->Session->setFlash(__('The Lesson has been saved'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				));
				return $this->redirect(array('controller' => 'Lecturer', 'action' => 'index'));
			}
			else{
				$this->Session->setFlash(__('The User could not be saved. Plz try again'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-warning'
				));	
			}
    	}
    }

}