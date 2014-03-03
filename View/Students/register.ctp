<h1>学生のアカウントを登録する</h1>
<?php 
echo("<h2>プロファイル</h2>");
echo $this->Form->Create("Students", array("action"=>"register", "type"=>"post"));
echo $this->Form->input("full_name", array("label"=>"名前（＊）"));
echo "生年月日";
//echo $this->Form->year("birthday", array("label"=>"年", "minYear"=>date('Y')-USER_AGE_MAX, "maxYear"=>date('Y')-USER_AGE_MIN+1, "empty"=>array('---')));
echo $this->Form->input("birthday"); 
echo $this->Form->input("address", array("label"=>"場所（＊）"));
echo $this->Form->input("phone_number", array("label"=>"携帯電話（＊）"));
echo $this->Form->input("email", array("label"=>"Email（＊）"));
echo("<h2>パスワード</h2>");
echo $this->Form->input("username", array("label"=>"ユーザ名（＊）"));
echo $this->Form->input("password", array("label"=>"Password（＊）", "type"=>"password"));
echo $this->Form->input("rePassword", array("label"=>"Password again（＊）", "type"=>"password"));
echo("<h2>アカウント</h2>");
echo $this->Form->input("credit_card_number", array("label"=>"Credit card（＊）"));
echo ("<h2>Random Question</h2>");
echo $this->Form->input("answer_verifycode", array("label"=>"answer_verifycode"));
echo $this->Form->end("Register");

?>
