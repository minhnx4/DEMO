<div class="row">
<?php echo $this->element('admin_menus');?>
<div class="col-xs-13 col-md-9"> 
<?php if($infor == NULL){
    echo "データがない";
}
else{
//var_dump($infor);
?>
<h2>詳しい情報</h2>    
<table class="table">
    <tr>
        <td>ユーザ名</td>
        <td><?php echo $infor[0]['Users']['username'];?></td>
    </tr>
    <tr>
        <td>初期パスワード</td>
        <td><?php echo $infor[0]['Lecturers']['init_password'];?></td>
    </tr>
        <td>氏名</td>
        <td><?php echo $infor[0]['Lecturers']['full_name'];?></td>
    </tr>
    </tr>
        <td>生年月日</td>
        <td><?php echo $infor[0]['Lecturers']['date_of_birth'];?></td>
    </tr>
    </tr>
        <td>住所</td>
        <td><?php echo $infor[0]['Lecturers']['address'];?></td>
    </tr>
    </tr>
        <td>電話番号</td>
        <td><?php echo $infor[0]['Lecturers']['phone_number'];?></td>
    </tr>
    </tr>
        <td>銀行口座情報</td>
        <td><?php echo $infor[0]['Lecturers']['credit_card_number'];?></td>
    </tr>
    </tr>
        <td>初期Verifycode</td>
        <td><?php echo $infor[0]['Lecturers']['init_verifycode'];?></td>
    </tr>
</table>    
<?php
}
?>
</div>
</div>