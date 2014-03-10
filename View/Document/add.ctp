<html>
<head>
<meta charset='utf-8'/>
<title> 新授業を作成する</title>

<script type="text/javascript">
	var rowNum = 1;
	function addRow(frm) {
	rowNum ++;
	var row =
	'<div class="tag" id="rowNum'+rowNum+'">'+
	'<span>ドキュメント</span>'+	
	'<input type="text" name="title[]">'+	
	'<?php echo $this->Form->input("file'+rowNum+'", array("type" => "file"));?>'+	
	'<input type="button" value="削除" onclick="removeRow('+rowNum+');">'+
	'</div>';

	jQuery('#mul').append(row);
	frm.add_qty.value = '';
	frm.add_name.value = '';
	}

	function removeRow(rnum) {
	jQuery('#rowNum'+rnum).remove();
	}
</script>

</head>
<body>
	<div class='header'>ファイルをアップロード</div>
	<form name="upload-form" action="/elearning/document/add" method="post" enctype="multipart/form-data">	
		<div class='main-ul'>
		<div id='mul'>
		<div class='tag'>
		<input onclick="addRow(this.form);" type="button" value="追加" />
		</div>
		<div class='tag'>
		<span>ドキュメント</span>	
		<input type='text' name='title[]'>
		<?php echo $this->Form->input('file0', array('type' => 'file', 'multiple'));?>

		</div>
		</div>
		<br>
		<div class='tag'>
		<input type='checkbox' name='check'>
		<p>私はそのドキュメントを専従する</p>
		</div>
		<div class='tag'>
		<input type='submit' name='submit' value='アップロード'>
		<input type='reset' value='リセット'>
		</div>
		</div>
	</form>
</body>
</html>