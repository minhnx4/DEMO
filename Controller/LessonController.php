<?php 
class LessonController extends AppController {
	var $name = "Lesson";
  	var $uses = array('User', 'Lecturer','Question','Lesson','Tag', 'Document', 'Test');
  	public $components = array('RequestHandler', 'Paginator');

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
    	//var_dump($lesson_id);
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
				return $this->redirect(array('controller' => 'Lecturer', 'action' => 'manage'));
			}
			else{
				$this->Session->setFlash(__('The Lesson Info could not be saved. Plz try again'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-warning'
				));	
			}
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
		return $this->redirect(array('controller' => 'Lecturer', 'action' => 'manage'));
    }

    public function detail_doc()
	{	
		$lession_id = $this->params['named']['id'];
		$lession_id = 1;

		$this->paginate = array(
		    'fields' => array('Document.id', 'Document.link', 'Document.title'),
			'limit' => 10,
			'conditions' => array(
				'Document.lesson_id' => $lession_id
			)
		);

		$this->Paginator->settings = $this->paginate;
		$data = $this->Paginator->paginate("Document");
		$this->set('results',$data);
	}

	public function detail_test() {
		$lesson_id = $this->params['named']['id'];
		$lesson_id = 21;

		$this->paginate = array(
		    'fields' => array('Test.id', 'Test.test_time', 'Test.link', 'Test.title'),
			'limit' => 10,
			'conditions' => array(
				'Test.lesson_id' => $lesson_id
			)
		);

		$this->Paginator->settings = $this->paginate;
		$data = $this->Paginator->paginate("Test");
		$this->set('results', $data);
	}

	public function detail_coin() {

	}

	public function detail_std() {

	}

	public function summary() {

	}

	public function report() {
		
	}
}