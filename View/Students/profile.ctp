<div class="row">
    <?php echo $this->Session->flash(); ?>
    <div class="col-md-8 col-md-offset-2 well">  
<?php 
//var_dump($student);
    echo ("<b>Full name</b></br>");
    echo $student['full_name']."</br>";
    echo ("<b>Username</b></br>");
    echo $student['username']."</br>";
    echo ("<b>Address</b></br>");
    echo $student['address']."</br>";
    echo ("<b>Email</b></br>");
    echo $student['email']."</br>";
    echo ("<b>Date of Birth</b></br>");
    echo $student['date_of_birth']."</br>";
    echo ("<b>Credit_card_numberr</b></br>");
    echo $student['credit_card_number']."</br>";
    echo ("<b>Ramdom question answer</b></br>");
    echo $student['answer_verifycode']."</br>";
    echo $this->Html->link("Fix account",array("controller"=>"students", "action"=>"fix_account"));
    echo "<br>";
    echo $this->Html->link("Delete account", array("controller"=>"students", "action"=>"delete"));

    
?>
</div>
