<div class="row">
<?php echo $this->element('admin_menus');?>
<div class="col-xs-13 col-md-9"> 
<h2>先生管理</h2>
<?php echo $this->element('admin_search');?>
<?php echo $this->Session->flash();    ?>
<?php
if(isset($data))
if($data != NULL){
?>

<table class="table table-striped">
    <tr>
        <td>順番</td>
        <td>ユーザ名</td>
        <td>氏名</td>
        <td>登録情報</td>
        <td>状態</td>
        <td>パスワードリセット</td>
        <td>verifycodeリセット</td>
        <td>アカウント削除</td>
    </tr>   
<?php  
$i=1;
foreach($data as $item){
    echo "<tr>";
        echo "<td>".$i++."</td>";
        echo "<td>".$item['Users']['username']."</td>";
        echo "<td>".$item['Lecturers']['full_name']."</td>";
        echo "<td><a href =''>".$this->html->link('見る',array('controller'=>'admins','action'=>'view_infor_lecturer',$item['Lecturers']['id']))."</a></td>";
if($item['Users']['actived'] == 0){
        echo "<td><a href =''>".$this->html->link('無効',array('controller'=>'admins','action'=>'unlock_lecturer',$item['Lecturers']['id']))."</a></td>";
}
if($item['Users']['actived'] == 1){
        echo "<td><a href =''>".$this->html->link('可用',array('controller'=>'admins','action'=>'lock_lecturer',$item['Lecturers']['id']))."</a></td>";
}
        echo "<td><a href =''>".$this->html->link('リセット',array('controller'=>'admins','action'=>'reset_password_lecturer',$item['Lecturers']['id'],$item['Lecturers']['init_password']))."</a></td>";
        echo "<td><a href =''>".$this->html->link('リセット',array('controller'=>'admins','action'=>'reset_verifycode_lecturer',$item['Lecturers']['id'],$item['Lecturers']['init_verifycode']))."</a></td>";
        echo "<td><a href =''>".$this->html->link('削除',array('controller'=>'admins','action'=>'delete_lecturer',$item['Lecturers']['id']))."</a></td>";
    echo "</tr>";
}
?>
</table>
<?php
}
?>
</div>


</div>