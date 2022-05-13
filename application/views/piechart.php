<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Codeigniter Google Pie Charts Demo</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
	<?php $this->load->view('admin_header');?>
</head>
<body>
	<body>
		<div class="container">
			<div class="mt-5">
				<div id="GooglePieChart" style="height: 600px; width: 100%"></div>
			</div>
		</div>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script>
			google.charts.load('visualization', "1", {
				packages: ['corechart']
			});
			google.charts.setOnLoadCallback(drawBarChart);
			
			// Pie Chart
			google.charts.setOnLoadCallback(showBarChart);
			function drawBarChart() {
				var data = google.visualization.arrayToDataTable([
					['Day', 'Products Count'], 
						<?php 
							foreach ($products as $row){
							   echo "['".$row['name']."',".$row['sell']."],";
							}
						?>
				]);
				var options = {
					title: ' Pie chart data',
					is3D: true,
				};
				var chart = new google.visualization.PieChart(document.getElementById('GooglePieChart'));
				chart.draw(data, options);
			}
		</script>
	</body>
</html>
<?php $this->load->view('admin_footer');?>