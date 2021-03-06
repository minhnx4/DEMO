<div class="row">
	<?php echo $this->Session->flash(); ?>

	<div class="col-xs-5 col-md-3">
		<ul class="nav nav-pills nav-stacked" id="myTab">
			<li>
				<?php echo $this->html->link('ファイル情報', array('controller' => 'lesson', 'action' => 'detail_doc',
					'id' => $id));?> 
			</li>
			<li class="active">
				<?php echo $this->html->link('テスト情報', array('controller' => 'lesson', 'action' => 'detail_test',
					'id' => $id));?> 
			</li>
			<li>
				<?php echo $this->html->link('課金情報', array('controller' => 'lesson', 'action' => 'detail_coin',
					'id' => $id));?> 
			</li>
			<li>
				<?php echo $this->html->link('学生リスト', array('controller' => 'lesson', 'action' => 'detail_std',
					'id' => $id));?> 
			</li>
			<li>
				<?php echo $this->html->link('サマリー情報', array('controller' => 'lesson', 'action' => 'sammary',
					'id' => $id));?> 
			</li>
			<li>
				<?php echo $this->html->link('レポート', array('controller' => 'lesson', 'action' => 'report',
					'id' => $id));?> 
			</li>			
		</ul>
	</div>
	<div class="col-xs-13 col-md-9">
		<div class="well">
			<?php echo $this->Paginator->pagination(array(
				'ul' => 'pagination'
				)); ?>		
			<table class="table bordered-table">
				<tr>
					<td  class="col-sm-1"><?php echo $this->Paginator->sort('id'); ?></td>	
					<td  class="col-sm-1">Title</td>	
					<td  class="col-sm-1">Time</td>	
					<td  class="col-sm-1">Link</td>			
					<td  class="col-sm-1">Edit</td>
					<td  class="col-sm-1">Delete</td>					
				</tr>
			 <?php foreach ($results as $result) {?>
			  <tr>
			  	<td><?php echo($result['Test']['id']) ?> </td>
			  	<td><?php echo($result['Test']['title']) ?> </td>
			  	<td><?php echo($result['Test']['test_time']) ?> </td>
			  	<td><?php echo($result['Test']['link']) ?> </td>
			  	<td><?php echo $this->Html->image("edit.png", array("alt" => "edit",'url' => array('controller' => 'test', 'action' => 'edit', "id"=>$result['Test']['id']))); ?>
			  	</td>
			  	<td><?php echo $this->Html->image("trash.png", array("alt" => "delete",'url' => array('controller' => 'test', 'action' => 'delete', "id"=>$result['Test']['id']))); ?>
			  	</td>
			  </tr>
			 <?php }?>
			</table>			
		</div>		
	</div>
</div>
