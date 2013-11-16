<?php
require_once('./config.php');
require_once('./Scraper.php');

$name = $_REQUEST['name'];

$url = Config::getFromName($name);

$scraper = new Scraper($url);
$scraper->load();

$cache = $scraper->getData();

header('Content-type: text/plain; charset=utf-8');
//print "Date\tCount\n";


if (!$cache) {
    return;
}


// min
$min = time();
foreach ($cache as $type => $data) {
	foreach ($data as $time => $count) {
		$min = min($time, $min);
	}
}

$x_axis = array();



print "Type\t";
for ($i=$min; $i<time()+86400;$i+=86400) {
	$time = strtotime(date('Y-m-d',$i));
	$x_axis[] = $time;
	print date('Y-m-d', $time)."\t";
}


print "\n";

foreach ($cache as $type => $data) {
	print "$type\t";
//	foreach ($data as $time => $count) {
	foreach ($x_axis as $time) {
		$count = isset($data[$time]) ? $data[$time] : $data[$time-8*60*60];
		print $count ? $count : 0;
		print "\t";
	}
	print "\n";
}

