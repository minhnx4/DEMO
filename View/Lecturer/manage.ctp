<div class="row">
	<?php echo $this->Session->flash(); ?>

	<div class="col-xs-5 col-md-3">
		<ul class="nav nav-pills nav-stacked" id="myTab">
			<li class="active"><a href="/lecturer/">Class Manager</a></li>
			<li><a href="/lecturer/lesson">New Class</a></li>
			<li><a href="#">Messages</a></li>
		</ul>
	</div>
	<div class="col-xs-13 col-md-9">
		<div class="well">
			<?php echo $this->Paginator->pagination(array(
				'ul' => 'pagination'
				)); ?>
			<table class="table table-condensed">
				<tr>
					<td  class="col-sm-1"><?php echo $this->Paginator->sort('id'); ?></td>
					<td  class="col-sm-1"><?php echo $this->Paginator->sort('Name');?></td>
					<td  class="col-sm-3">Description</td>
				</tr>
			 <?php foreach ($results as $result) {?>
			  <tr>
			  	<td><?php echo($result['Lesson']['id']) ?> </td>
			  	<td><?php echo($result['Lesson']['Name']) ?> </td>
			  	<td><?php echo($result['Lesson']['summary']) ?> </td>
			  </tr>
			 <?php }?>
			</table>
		</div>
	</div>
</div>
