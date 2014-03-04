<?php

class StudentsController extends AppController {
	public function beforeFilter(){
	//	$this->Auth->allow("index");	
	}

	public function index(){
		
	}
	
	public function register(){
        if($this->request->is("post")){
            $full_name = $this->data["Students"]["full_name"];
            $address = $this->data['Students']['address'];
            $phone_number = $this->data["Students"]["phone_number"];
            $email = $this->data["Students"]["email"];
            $username = $this->data["Students"]["username"];
            $password = $this->data["Students"]["password"];
            $repassword = $this->data['Students']['rePassword'];
            $credit_card_number = $this->data["Students"]["credit_card_number"];
            $answer_verifycode = $this->data["Students"]["answer_verifycode"];
            $birthday = $this->data["Students"]["birthday"];


            //Gia su nhu oke het roi
            
        }    
    }
}
