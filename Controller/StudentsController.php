<?php

class StudentsController extends AppController {
   var $helpers = array("Html", "Form");//このところはちょっと変、AppController　にあるのに
   var $components = array("Auth");//ここも

    public function beforeFilter(){
		$this->Auth->allow("register");	
        
    }

	public function index(){
		
	}
	
	public function register(){
        if($this->Auth->user("id")){
            $id = $this->Auth->user("id");
            echo ($id);    
            $student = $this->Student->find('first', array('conditions'=>array('id'=>$id)));  

            $this->set('student',$student); 
        }else if($this->request->is("post")){
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
            $student_info = array("full_name"=>$full_name, "address"=>$address, "phone_number"=>$phone_number, "emeil"=>$email, "username"=>$username, "password"=>"$password", "repassword"=>$repassword, "credit_card_number"=>$credit_card_number); 

            //チェックがよければ、データベースに保存してプロファイルの画面に移動する
            $this->Student->save($student_info);
            $user_id = $this->Student->getLastInsertId();
            echo ("id cua nguoi dung la ".$user_id);
            $this->Auth->login(array("id"=>$user_id));
            $user_id= $this->Auth->user("id"); 
            $this->redirect(array("controller"=>"students", "action"=>"profile"));
        }    
    }

    public function profile(){
        $id = $this->Auth->user("id");
        echo ($id);    
        $student = $this->Student->find('first', array('conditions'=>array('id'=>$id)));  
//        var_dump($student);
//    $name = $student->Student->full_name; 
//    echo $name; 
        $this->set('student', $student['Student']);
    }
}
