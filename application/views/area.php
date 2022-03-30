<head>
    <meta charset=utf-8 />
    <title>Codeigniter 3 Area Chart and Line Chart Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div>
            <label class="label label-success">Codeigniter Line Chart Example</label>
            <div id="lineChart"></div>
        </div>                
        

        <div>
            <label class="label label-success">Codeigniter Area Chart Example</label>
            <div id="areaChart"></div>
        </div>
    </div>
    <!-- Add Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
            var areaserries = <?php echo json_encode($products); ?>;
           
            var data = areaserries,
                config = {
                    data: <?php echo json_encode($products); ?>,
                    fillOpacity: 0.5,                
                    xkey: 'year',
                    ykeys: ['expenses'],
                    labels: ['Students Expense Data'],
                    hideHover: 'auto',
                    behaveLikeLine: true,
                    resize: true,
                    lineColors:['green','orange'],
                    pointFillColors:['#ffffff'],
                    pointStrokeColors: ['blue'],
            };
            config.element = 'lineChart';
            Morris.Line(config);            
    
            config.element = 'areaChart';
            Morris.Area(config);
    </script>
</body>