<div class="row">
	<?php echo $this->Session->flash(); ?>

	<div class="col-xs-5 col-md-3">
		<ul class="nav nav-pills nav-stacked" id="myTab">
			<li class="active"><a href="#">Class Manager</a></li>
			<li><a href="/lecturer/lesson">New Class</a></li>
			<li><a href="#">Messages</a></li>
		</ul>
	</div>
	<div class="col-xs-13 col-md-9">

	</div>
</div>

<script type="text/javascript">
	$('#myTab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
</script>