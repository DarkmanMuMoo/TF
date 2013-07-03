<?= $this->load->view('include/bakheader'); ?>

<div class="span10">
	<div class="page-header">
		<h1>ScoreReport <small>Top 10 </small>

<div class="pull-right"> <a  href="<?=  site_url('Backend/scoreReport/view_all');  ?>" target="_blank"  class="btn btn-info"  > View All</a>    </div>
		</h1>

	</div>
	<div id="result"  align="center">
		<table class="table table-bordered">
			<thead>
				<th>#</th>
				<th>Username</th>
				<th>Name</th>
				<th>fontCode</th>
				<th>Score</th>
			</thead>
			<tbody>
				<?php foreach ($scorereport as $index=>$score): ?>
				<tr>
					<td><?=$index+1 ?></td>
					<td><?=$score->Username?></td>
					<td><?=$score->Name.' '.$score->Lastname?> </td>
					<td><?=$score->FontCode?> </td>
					<td><?=$score->score?> </td>
				</tr>
			<?php endforeach; ?>



		</tbody>


	</table>

	<canvas  width="1000"  height="500"  id="score-chart" >
		
	</canvas>

</div>

</div>

<?= $this->load->view('include/bakfooter'); ?>
<script src="<?= base_url('asset/javascripts/Chart.js'); ?>" type="text/javascript" charset="utf-8" async defer></script>
<script type="text/javascript">
App.showGraph();

</script>