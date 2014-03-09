<?php echo $this->Html->script('jquery.validate', array('inline' => false));?>
<html>
	<head>
		<meta charset='utf-8'/>
		<title> 新授業を作成する</title>			
	</head>
	<body class='upload'>
		<div class='header'><h3>ファイルをアップロード</h3></div>		
		<?php echo $this->Form->create('Test', array('url' => array('controller' => 'lecturer', 'action' => 'upload_test'),
		'enctype' => 'multipart/form-data', 'id' => 'testid'));?>

			<div class='main-ul'>
				<div class='tag'>				
					<span><b>ファイルの名前</b></span>
					<?php echo $this->Form->input('title', array(
						'class' => 'input-xlarge',						
						'label' => false, 
						'placeholder' => 'ファイル', 
						'div' => false,
						'class' => 'text-input'));
					?>
				</div>							
				<div class='tag_'>											
					<?php echo $this->Form->input('link', array('type' => 'file'));?>					
				</div>				
				<div class='tag'>
					<span><b>テスト時間</b></span>										
					<?php echo $this->Form->input('test_time', array(
						'class' => 'input-xlarge', 						
						'label' => false, 
						'placeholder' => '時間', 						
						'class' => 'time-input'));					
					?>
					<span> 単位：（分）</span>					
				</div>
				<div class='tag'>
					<span><b>授業の説明</b></span>	
				</div>				
				<?php
				echo $this->Form->textarea('des', array(
					'class' => '',							
					'label' => false, 
					'placeholder' => '説明', 
					'div' => false));
				?>
				<br><br>
				<div class='tag'>					 
					<?php echo $this->Form->submit('アップロード', array('class' => 'btn btn-primary', 'div' => false));?>
					<?php echo $this->Form->reset('再アップロード', array('class' => 'btn btn-primary', 'div' => false, 
					'value' => '再アップロード'));?>	
				</div>
			</div>		
		</form>
	</body>
</html>