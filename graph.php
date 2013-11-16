<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Data tracker for facebook</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Le styles -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	</head>

	<body>

		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#">Facebook's page tracking.</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li class="active"><a href="/facebook/page_tracking/">Home</a></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>

		<div class="container">

			<h1>Graph</h1>

				<div id="graph"></div>


		</div> <!-- /container -->

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> 
		<script src="highcharts/js/highcharts.js" type="text/javascript"></script>
		<script src="highcharts/js/themes/gray.js" type="text/javascript"></script>

<script type="text/javascript">

var options = {
    chart: {
        renderTo: 'graph',
        defaultSeriesType: 'line'
    },
    title: {
        text: ''
    },
    xAxis: {
        categories: []
    },
    yAxis: {
        title: {
            text: 'Count'
        },
				plotLines: [{
					value: 0,
						width: 1,
						color: '#808080'
				}]
    },
		tooltip: {
			shared: true,
				crosshairs: true
		},
    series: []
};




$.get('chart_data.php?name=<?= $_REQUEST['name'] ?>', function(data) {
	// Split the lines
	var lines = data.split('\n');

	// Iterate over the lines and add categories or series
	$.each(lines, function(lineNo, line) {
		var items = line.split("\t");

		if (line == '') {
			return;
		}

		// header line containes categories
		if (lineNo == 0) {
			$.each(items, function(itemNo, item) {
				if (itemNo > 0) options.xAxis.categories.push(item);
			});
		}

		// the rest of the lines contain data with their name in the first position
		else {
			var series = {
				data: []
			};
			$.each(items, function(itemNo, item) {
				if (itemNo == 0) {
					series.name = item;
				} else {
					series.data.push(parseInt(item));
				}
			});
			options.series.push(series);
		}
	});

	// Create the chart
	var chart = new Highcharts.Chart(options);
});




</script>


	</body>
</html>


