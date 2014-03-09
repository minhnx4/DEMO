<?php 
class LessonController extends AppController {
	var $name = "Lesson";
  	var $uses = array('User', 'Lecturer','Question','Lesson','Tag','LessonMembership');	
  	public function beforeFilter() {
        parent::beforeFilter();
    }
    public function add($value='')
    {
    	if($this->request->is('post')){
	    	$data = ($this->request->data);
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
				return $this->redirect(array('controller' => 'Lecturer', 'action' => 'manage'));
			}
			else{
				$this->Session->setFlash(__('The User could not be saved. Plz try again'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-warning'
				));	
			}
    	}
    }
    public function edit(){
    	$lesson_id = $this->params['named']['id'];
		$Lesson = $this->Lesson->findById($lesson_id);
		if (!$Lesson) {
			$this->Session->setFlash(__('This Lesson not exist'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-warning'
			));	
			return $this->redirect(array('controller' => 'Lecturer', 'action' => 'manage'));		
		}
		$this->set("id",$lesson_id);

    	if($this->request->is('post')){
	    	$data = ($this->request->data);
	    	$data['Lesson']['lecturer_id'] = $this->Auth->user('id');
	    	$rawtags = explode(",",$data["hidden-data"]['Tag']['name']);
	    	$tags = array();
	    	foreach ($rawtags as $key => $value) {
	    		#var_dump($value);
		    	$tag = $this->Tag->findByName($value);
		    	if (!$tag) {
		    		$this->Tag->create();
		    		$this->Tag->set("name",$value);
		    		$tag = $this->Tag->save();
		    	}
	    		array_push($tags, $tag['Tag']['id']);
	    	}
	    	$data['Tag'] = $tags;
			if($this->Lesson->saveAll($data)){
				$this->Session->setFlash(__('The Lesson Info has been saved'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				));
			}
			else{
				$this->Session->setFlash(__('The Lesson Info could not be saved. Plz try again'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-warning'
				));	
			}			
			return $this->redirect($this->referer());
    	}
    }

    public function delete($value='')
    {
    	$lesson_id = $this->params['named']['id'];
    	$lesson = $this->Lesson->find("first", array('conditions' => array('Lesson.id' => $lesson_id))); 
    	if($lesson && $this->Lesson->delete($lesson_id)){
			$this->Session->setFlash(__('The Lesson has been Removed'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-success'
			));
    	}else{
				$this->Session->setFlash(__('The Lesson could not be deleted. Plz try again'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-warning'
			));	

    	}
		return $this->redirect($this->referer());
    }


    public function deletestudent($value=''){
    	$lesson_id = $this->params['named']['lesson_id'];
    	$student_id = $this->params['named']['student_id'];

    	$member = $this->LessonMembership->find("first",array(
    				'conditions' => array('lesson_id' => $lesson_id ,'student_id' => $student_id )
    			)
    		);

    	if($this->LessonMembership->delete($member['LessonMembership']['id'])){
			$this->Session->setFlash(__('The User has been Removed'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-success'
			));
    	}else{
				$this->Session->setFlash(__('The User could not be deleted. Plz try again'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-warning'
			));	
    	}
		return $this->redirect($this->referer());

    }

    public function banstudent($value=''){
    	$lesson_id = $this->params['named']['lesson_id'];
    	$student_id = $this->params['named']['student_id'];

    	$member = $this->LessonMembership->find("first",array(
    				'conditions' => array('lesson_id' => $lesson_id ,'student_id' => $student_id )
    			)
    		);
		$member['LessonMembership']['baned'] = !$member['LessonMembership']['baned'];

    	if($this->LessonMembership->save($member)){
			$this->Session->setFlash(__('The User has been Baned'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-success'
			));
    	}else{
				$this->Session->setFlash(__('The User could not be baned. Plz try again'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-warning'
			));	
    	}
		return $this->redirect($this->referer());

    }


}