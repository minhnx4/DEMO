<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

class UsersController extends AppController {
	var $uses = array('User', 'Lecturer','Question');
    var $components = array("Auth");
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
        $this->Auth->allow('verifycode');
    }

	public function index($value='')
	{
	}

    public function add(){
    	if($this->request->is('post')){
    		$this->User->create();
    		if($this->User->save($this->request->data)){
    			$this->Session->setFlash(__('The user has been saved'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				));
    			return $this->redirect(array('controller' => 'user', 'action' => 'login'));
    		}
			$this->Session->setFlash(__('The User could not be saved. Plz try again'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-warning'
			));
    	}

    }
 
	public function login() {

	   	if($this->Auth->loggedIn()){
      	  $this->redirect('/');
    	}
    	$failedTime = $this->Session->read('failedTime');
    	if($failedTime >=5) {
    		$this->redirect(array('controller'=>'Users','action'=>'verifycode'));
    	}
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	        	$this->Session->write('failedTime',0);

	        	$user = $this->Auth->user();
	        	if($user['role'] == 'lecturer' && $this->request->clientIp() != $user['Lecturer']['ip_address'])
	        	{
	        		$this->redirect(array('controller'=>'Users','action'=>'verifycode'));
	        	}
	        	if($user['role'] == 'student')
	        	{
	        		$this->redirect(array('controller'=>'Students','action'=>'profile'));
	        	}
	        	if($user['role'] == 'admin')
	        	{
	        		$this->redirect(array('controller'=>'Admins'));
	        	}
	        	if ($user['role'] == 'lecturer') {
	        		return $this->redirect(array('controller' => "lecturer" ));
	        	}	            
	            return $this->redirect(array('controller' => "lecturer" ));
	        }else
	        {

	        	$failedTime = $this->Session->read('failedTime');
	        	if(isset($failedTime))
		        	$this->Session->write('failedTime',$failedTime+1);
		        else
		        	$this->Session->write('failedTime',1);

		        $this->Session->setFlash(__('Invalid username or password, try again '.$failedTime .' time(s)'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-warning'
				));	
	        }
	    }
	}

	public function logout(){
		return $this->redirect($this->Auth->logout());
	}

	public function verifycode($value='')
	{
	
		$this->Auth->logout();
		$questions = $this->Question->find('all');
    	$droplist = array();
    	foreach ($questions as $question) {
     		$droplist[$question['Question']['id']] = $question['Question']['question'];
    	}
    	$this->set('droplist', $droplist);

		if ($this->request->is('post')) {
			$data = ($this->request->data);
	    	var_dump($data);
			if ($this->Auth->login()) {
	        	$this->Session->write('failedTime',0);
				$user = $this->Auth->user();
				if($user['role'] == 'lecturer' && $data['Lecturer']['question_verifycode_id'] == $user['Lecturer']['question_verifycode_id'] 
					 && $data['Lecturer']['current_verifycode'] == $user['Lecturer']['current_verifycode']){
					$this->Lecturer->id = $this->Auth->user('id');
					if ($this->Lecturer->saveField('ip_address',$this->request->clientIp())) {
						$this->Session->setFlash(__('The new ip address has been saved'),'alert', array(
							'plugin' => 'BoostCake',
							'class' => 'alert-success'));
					} else {
						$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'alert', array(
													'plugin' => 'BoostCake',
													'class' => 'alert-warning'
												));
					}
				}elseif ($user['role'] == 'student' && $data['Lecturer']['question_verifycode_id'] == $user['Student']['question_verifycode_id'] 
					 && $data['Lecturer']['current_verifycode'] == $user['Student']['current_verifycode']) {
						$this->Session->setFlash(__('OK'),'alert', array(
							'plugin' => 'BoostCake',
							'class' => 'alert-success'));
				}
				else
					$this->Auth->logout();


	            return $this->redirect(array('controller' => "lecturer", "action" => "index" ));
			}

			$this->Session->setFlash(__('Invalid username or password, try again'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-warning'
			));
		}
	}
	public function permission($value='')
	{
		$this->Session->setFlash(__("You don't have permission to visit this page"), 'alert', array(
		'plugin' => 'BoostCake',
		'class' => 'alert-warning'
		));
	}
}
