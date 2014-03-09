<?php

class LecturerController extends AppController {
	var $name = "Lecturer";
  	var $uses = array('User', 'Lecturer','Question','Lesson', 'Test', 'Document');	

	public $components = array('RequestHandler', 'Paginator');		
	#public $helpers = array('Js' => array('Jquery'), 'Paginator');

    
  	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('add', 'upload_test', 'manage', 'view'));
    }

    public function add(){

    	if($this->Auth->loggedIn()){
      	  $this->redirect('/');
    	}
    	$questions = $this->Question->find('all');
    	$droplist = array();
    	foreach ($questions as $question) {
     		$droplist[$question['Question']['id']] = $question['Question']['question'];
    	}
    	$this->set('droplist', $droplist);
		if($this->request->is('post')){
			$this->User->create();
			$this->request->data['Lecturer']['ip_address'] = $this->request->clientIp();
			$this->request->data['User']['role'] = 'lecturer';

			if($this->User->saveAll($this->request->data)){
				$this->Session->setFlash(__('The user has been saved'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				));
				return $this->redirect(array('controller' => 'pages', 'action' => 'display'));
			}
			$this->Session->setFlash(__('The User could not be saved. Plz try again'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-warning'
			));
		}
	}
	public function index(){
		$user = $this->Auth->user();
		if($user["role"] != 'lecturer'){
			$this->redirect(array('controller' => 'users' ,"action" => "permission" ));
		}
	}
	public function lesson($value='')
	{
		
	}	

	public function manage($value='')
	{
		$this->paginate = array(
		    'fields' => array('Lesson.id', 'Lesson.Name','Lesson.summary'),
			'limit' => 10,
			'conditions' => array(
				'Lesson.lecturer_id' => $this->Auth->user('id')
			)
		);

		$this->Paginator->settings = $this->paginate;
		$data = $this->Paginator->paginate("Lesson");
		$this->set('results',$data);
	}
}