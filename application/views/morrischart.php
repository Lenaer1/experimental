<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Codeigniter Morris Stacked and Bar Charts Demo</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	
</head>
<body>
	<body>
		<div class="container">
    		<div class="mt-5">
			<h2 class="text-center mb-5">Codeigniter Morris Stacked Chart Example</h2>
				<div id="MorrisStakcedChart" style="height: 400px; width: 100%"></div>
			</div>		
			<div class="mt-5">
			    <h2 class="text-center mb-5">Codeigniter Morris Bar Chart Example</h2>
				<div id="MorrisBarChart" style="height: 400px; width: 100%"></div>
			</div>
		</div>
        <!-- Add scripts -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
		<script>
			var serries = <?php echo json_encode($products); ?>;
			var data = serries,
				config = {
					data: <?php echo json_encode($products); ?>,
					xkey: 'day',
					ykeys: ['s'],
					labels: ['Sales this week'],
					fillOpacity: 0.7,
					hideHover: 'auto',
					resize: true,
					behaveLikeLine: true,
					stacked: true,
					barColors: "455"
			    };
			
			// Call bar chart
			config.element = 'MorrisBarChart';
			Morris.Bar(config);
			
			// Call stacked chart
			config.element = 'MorrisStakcedChart';
			config.stacked = true;
			Morris.Bar(config);
		</script>
	</body>
</html>
<?php $this->load->view('admin_footer');?>