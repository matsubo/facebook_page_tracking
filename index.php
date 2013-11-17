<?php 
require_once('config.php');
?><!DOCTYPE html>
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
							<li class="active"><a href="index.php">Home</a></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>

		<div class="container">

			<h1><img src="img/png/FB-f-Logo__blue_29.png" alt="facebook" /> Data tracker for Facebook Page</h1>

                <div class="alert alert-info">
				<ul>
                    <li>"Raw data" format is TSV so you can copy and past the data to Excel directory or you can use the URL as web query source. </li>
                    <li>Data is acquired every 2am JST.</li>
                    <li>If you 'd like to add Facebook page to track, please add the setting to <a href="https://github.com/matsubo/facebook_page_tracking/blob/master/config.php">this config file</a> and send me a pull request via github.</li>
                </ul>
                </div>


<table class="table table-striped">
<?php foreach(Config::getURLArray() as $name => $url) { ?>
<tr>
<th style="text-align: left"><?= $name ?> <a href="http://wiki.dev.gree.jp/rd.php?url=<?php print urlencode($url); ?>" target="_blank"><i class="icon-home"></i></a></th>
	<td><a href="graph.php?name=<?= $name ?>" class="btn btn-success">Graph</a></td>
	<td><a href="chart_data.php?name=<?= $name ?>" class="btn">Raw data</a></td>
<!--
	<td><a href="show.php?name=<?= $name ?>&amp;type=3">Daily like</a></td>
	<td><a href="show.php?name=<?= $name ?>&amp;type=4">Daily "Talking About This"</a></td>
	<td><a href="show.php?name=<?= $name ?>&amp;type=1">Weekly like</a></td>
	<td><a href="show.php?name=<?= $name ?>&amp;type=2">Weekly  "Talking About This"</a></td>
-->
</tr>
<?php } ?>
</table>

		</div> <!-- /container -->

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->

	</body>
</html>


