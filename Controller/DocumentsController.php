<?php
class DocumentsController extends AppController{
    public $helpers = array("TsvReader");
    public function show($document_id){
        $document = $this->Document->find("first", array("conditions"=>array("id"=>$document_id)));
        $this->set("document", $document['Document']);
    }

    public function report($lesson_id,  $document_id){
        $document = $this->Document->find("first", array("conditions"=>array("id"=>$document_id)));
        $this->set("document", $document['Document']);
        if ($this->request->is('post')){
            $content = $this->data['report']['content'];
            $this->loadModel("Violate");
            $data = array("student_id"=>$this->Auth->user("id"), "document_id"=>"document_id", "content"=>$content, "accepted"=>0); 
            $this->Violate->save($data);
            $this->redirect(array("controller"=>"lessons","action"=>"learn",$lesson_id));  
        }
    }
}
