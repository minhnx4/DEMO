<h1>学生のプロファイル</h1>
<h2>プロファイル</h2>
<?php
    echo ("名前: ".$student['full_name']);
    echo ("生年月日".$student['date_of_birth']);
    echo("Address".$student['address']);
    echo("phone number".$student['phone_number']);
    echo ("Email:".$student['email']);
?>
<h2>銀行のアカウント</h2>
<?php
    echo ("Account Number: ".$student['credit_card_number']);
?>
<?php
 

echo $this->Html->link("自己情報を変更する", array("controller"=>"students", "action"=>"register"));
echo $this->Html->link("子のアカウントを削除する", array("controller"=>"student", "action"=>"delete"));
?>

