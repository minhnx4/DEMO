
<?php




/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


echo "<h1>新しいアカウントを追加</h1>";


echo $this->Form->create('User', array("controller" => "admin", "action" => "add_admin"));
echo $this->Form->input("username", array("label" => "ユーザ名"));
echo $this->Form->input("password", array("label" => "パスワード"));
echo $this->Form->input("repassword", array("label" => "パスワードを再記入"));
echo $this->Form->input("email", array("label" => "メール"));
echo $this->Form->input("ip_address", array("label" => "IP アドレス"));
echo $this->Form->button('add', array(
    'value' => '追加',
    'type' => 'post',
));

echo $this->Form->end();

echo "<h1>管理者リスト</h1>";


if ($res != null) {
    $admins = $res[0];
    echo '<table width="500" align=left cellpadding="3" cellspacing = "2" border=1>';
    echo "<tr>";

    echo "<td> 順番 </td>";
    foreach ($admins["admin"] as $key => $value) {
        echo "<td>" . $key . "</td>";
    }
    echo "<td> 削除 </td>";
    echo "</tr>";
    $i = 1;
     
    foreach ($res as $admin) {
        echo $this->Form->create('Admin', array("controller" => "admin", "action" => "remove_admin"));  
        echo "<tr>";
    
        $record = $admin["admin"];
        echo $this->Form->input("username", array("type" => "hidden","label" => "ユーザ名","value" => $record["username"]));
        echo "<td>" . $i . "</td>";
        echo "<td>" . $record["id"] . "</td>";
        echo "<td>" . $record["username"] . "</td>";
        echo "<td>" . $record["email"] . "</td>";
        echo "<td>" . $record["ip_address"] . "</td>";
        echo "<td>" . $this->Form->button('remove', array(
            'value' => '追加',
            'type' => 'post',
        )) . "</td>";

        echo "</tr>";
        $i++;
    }
    echo $this->Form->end();
    echo "</table>";
}
?>


