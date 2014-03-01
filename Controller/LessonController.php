<?php 
class LessonController extends AppController {
  	var $uses = array('User', 'Lecturer','Question','Lesson');	
  	public function beforeFilter() {
        parent::beforeFilter();
    }
    public function add($value='')
    {
    	var_dump($this->request->data);
    }

}