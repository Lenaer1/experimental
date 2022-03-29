<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Google Column Chart in Codeigniter</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
	<body>
		<div class="container">
			<div id="GoogleColumnChart" style="height: 500px; width: 100%"></div>
		</div>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script>
			google.charts.load('visualization', "1", {
				packages: ['corechart']
			});
			function showChart() {
				var data = google.visualization.arrayToDataTable([
					['Day', 'Products Count'], 
					<?php foreach($products as $row) {
						echo "['".$row['day']."',".$row['sell']."],";
					} ?>
				]);
				var options = {
					title: 'Last week sales',
					isStacked: true
				};
				var chart = new google.visualization.ColumnChart(document.getElementById('GoogleColumnChart'));
				chart.draw(data, options);
			}
			google.charts.setOnLoadCallback(showChart);
		</script>
	</body>
</html>