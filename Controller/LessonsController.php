<?php
class LessonsController extends AppController{
    public $helpers = array('LeftMenu');
    public function search(){
        if($this->request->is("post")){
            $lesson = $this->data['Lessons'];
            if (isset( $lesson['rank'])){
                $rank_stt = $lesson['rank'];
                $this->set("rank_stt", $rank_stt);
                if($rank_stt == RANK_BY_LECTURER){  //rank by lecturer's name
                    $options['fields'] = array('Lecturer.*', 'Lesson.*', 'User.*');
                    $options['joins'] = array(array("table"=>"lecturers", "alias"=>"Lecturer","conditions"=>array("Lesson.lecturer_id=Lecturer.id")), array("table"=>"users", "alias"=>"User", "conditions"=>array("User.id=Lecturer.id")));
                    $options['order'] = array("Lecturer.full_name");
                    $lessons = $this->Lesson->find("all", $options);
                    $this->set("lessons", $lessons);
                }else if ($rank_stt==RANK_BY_LESSON){//rank by lessons's name
                    $options['fields'] = array('Lecturer.*', 'Lesson.*', 'User.*');
                    $options['joins'] = array(array("table"=>"lecturers", "alias"=>"Lecturer","conditions"=>array("Lesson.lecturer_id=Lecturer.id")), array("table"=>"users", "alias"=>"User", "conditions"=>array("User.id=Lecturer.id")));
                    $options['order'] = array("Lesson.name");
                    $lessons = $this->Lesson->find("all", $options);
                    $this->set("lessons", $lessons);

                }else if ($rank_stt==RANK_BY_TAG){
                    $options['fields'] = array('Lecturer.*', 'Lesson.*', 'User.*', 'Tag.*');
                    $options['joins'] = array(
                        array("table"=>"lecturers", "alias"=>"Lecturer","conditions"=>array("Lesson.lecturer_id=Lecturer.id")), 
                        array("table"=>"users", "alias"=>"User", "conditions"=>array("User.id=Lecturer.id")),
                        array("table"=>"lessons_tags", "alias"=>"Lesson_Tag","conditions"=>array("Lesson.id=Lesson_Tag.lesson_id")),
                        array("table"=>"tags", "alias"=>"Tag", "conditions"=>array("Tag.id=Lesson_Tag.tag_id")), 
                    );
                    $options['order'] = array("Tag.name");
                    $lessons = $this->Lesson->find("all", $options);
                    $this->set("lessons", $lessons);
                }
            }
        }
        if ($this->request->is('get')) {
            if (isset($this->params['url']['search_value'])) {
                $tag_value = $this->params['url']['search_value'];
                echo  $tag_value; 
                $options['fields'] = array('Lecturer.*', 'Lesson.*', 'User.*', 'Tag.*');
                $options['joins'] = array(
                    array("table"=>"lecturers", "alias"=>"Lecturer","conditions"=>array("Lesson.lecturer_id=Lecturer.id")), 
                    array("table"=>"users", "alias"=>"User", "conditions"=>array("User.id=Lecturer.id")),
                    array("table"=>"lessons_tags", "alias"=>"Lesson_Tag","conditions"=>array("Lesson.id=Lesson_Tag.lesson_id")),
                    array("table"=>"tags", "alias"=>"Tag", "conditions"=>array("Tag.id=Lesson_Tag.tag_id")), 
                );
                $options['conditions'] = array("Tag.name LIKE" => "%".$tag_value."%");
                $lessons = $this->Lesson->find("all", $options);
                $this->set("lessons", $lessons);
            }
        }
    }
    public function show($lesson_id){
        $options['fields']= array("Lecturer.*", "User.*", "Lesson.*");
        $options['joins'] = array(
            array("table"=>"lecturers", "alias"=>"Lecturer",  "conditions"=>array("Lecturer.id = Lesson.lecturer_id")), 
            array("table"=>"users", "alias"=>"User", "conditions"=>array("User.id=Lesson.lecturer_id"))
        ); 
        $options['conditions'] = array("Lesson.id"=>$lesson_id); 
        //      array("table"=>"documents", "alias"=>"Document", "conditions"=>array("Document.lesson_id = Lesson.id")));
        //  $options['conditions'] = array("Lesson.id"=>$lesson_id); 
        $lessons = $this->Lesson->find("all",$options); 
        //Get tai lieu 
        $options['fields'] = array("Document.*");
        $options['joins'] = array(
            array("table"=>"documents", "alias"=>"Document", "conditions"=>array("Document.lesson_id = Lesson.id")));
        $options['conditions'] = array("Lesson.id"=>$lesson_id); 
        $documents = $this->Lesson->find("all", $options);
        $this->set("documents", $documents);

        //Get comment
        $options['fields'] = array("Comment.*");
        $options['joins'] = array(
            array("table"=>"comment", "alias"=>"Comment", "conditions"=>array("Comment.lesson_id = Lesson.id")));
        $options['conditions'] = array("Lesson.id"=>$lesson_id); 
        $comments = $this->Lesson->find("all", $options);
        $this->set("comments", $comments);


 /*


            array("table"=>"comments", "alias"=>"Comment", "condtions"=>array("Comment.lessons_id = Lesson.id"), 
            array("table"=>"like", "alias"=>"Like", "conditons"=>array("Comment.lessons_id = Lessons.id")), 
            array("table"=>"comments", "alias"=>"Comment", "conditions"=>array("Comment.lesson_id=Lessons.id")), 
            array("table"=>"study", "alias"=>"Study", "conditions"=>array("Study.lesson_id=Lessons.id", 
           array(" 
 array( "Comment", "Like", "Document", "Comment", "Study", "Test");*/

        $this->set("lessons", $lessons);


    }

    public function register($lesson_id){
        if ($this->request->is('post')){
            $user_id = $this->Auth->user('id');
            $this->loadModel('StudentsLesson');
            $data = array("student_id"=>$user_id, "lesson_id"=>$lesson_id) ;   
            $this->StudentsLesson->save($data);
            $this->redirect(array("controller"=>"lessons", "action"=>"learn", $lesson_id));
        }
    }

    public function learn($lesson_id){
        $this->loadModel("StudentsLesson");
        $options['fields']= array("Lecturer.*", "User.*", "Lesson.*");
        $options['joins'] = array(
            array("table"=>"lecturers", "alias"=>"Lecturer",  "conditions"=>array("Lecturer.id = Lesson.lecturer_id")), 
            array("table"=>"users", "alias"=>"User", "conditions"=>array("User.id=Lesson.lecturer_id"))
        ); 
        $options['conditions'] = array("Lesson.id"=>$lesson_id); 
        $lessons = $this->Lesson->find("all",$options); 
        $this->set("lessons", $lessons);
        //Get tai lieu 
        $options['fields'] = array("Document.*");
        $options['joins'] = array(
            array("table"=>"documents", "alias"=>"Document", "conditions"=>array("Document.lesson_id = Lesson.id")));
        $options['conditions'] = array("Lesson.id"=>$lesson_id); 
        $documents = $this->Lesson->find("all", $options);
        $this->set("documents", $documents);

        //Get comment
        $options['fields'] = array("Comment.*" ,"User.username");
        $options['joins'] = array(
            array("table"=>"comments", "alias"=>"Comment", "conditions"=>array("Comment.lesson_id = Lesson.id")), 
            array("table"=>"users", "alias"=>"User", "conditions"=>array("Comment.user_id = User.id" ))
        );
        $options['conditions'] = array("Lesson.id"=>$lesson_id); 
        $comments = $this->Lesson->find("all", $options);
      //  debug($comments);
        $this->set("comments", $comments);
       //受講した学生の数を数える
        $learnPeople = $this->StudentsLesson->find("count", array("conditions"=>array("lesson_id"=>$lesson_id)));
        $likePeople = $this->StudentsLesson->find("count", array("conditions"=>array("lesson_id"=>$lesson_id,  "liked"=>1)));
        //いいねの数を数える
        $res = $this->StudentsLesson->find("first", array("fields"=>"liked", "conditions"=>array("student_id"=>$this->Auth->user("id"), "lesson_id"=>$lesson_id))); 
        $this->set("liked", $res['StudentsLesson']["liked"]);
        $this->set("learnedPeople", $learnPeople);
        $this->set("likePeople", $likePeople);
    }

    public function like($lesson_id){
      //  $this->set("liked", true);
       $this->loadModel("StudentsLesson");
       $data = array("liked"=>1);
       $this->StudentsLesson->updateAll($data, array("lesson_id"=>$lesson_id, "student_id"=>$this->Auth->user("id")));
       $this->redirect($this->referer());
    }
   public function dislike($lesson_id){
      //  $this->set("liked", true);
       $this->loadModel("StudentsLesson");
       $data = array("liked"=>0);
       $this->StudentsLesson->updateAll($data, array("lesson_id"=>$lesson_id, "student_id"=>$this->Auth->user("id")));
       $this->redirect($this->referer());
   }

  public function comment($lesson_id, $content){
      //   $this->redirect("controller"=>"lessons", "action"=>"learn");
      $this->loadModel("Comment");
      $data = array("user_id"=>$this->Auth->user("id"), "lesson_id"=>$lesson_id, "content"=>$content);
      $this->Comment->save($data);
      $this->redirect($this->referer());
  }
}
?>
