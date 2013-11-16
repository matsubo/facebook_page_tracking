<?php
require_once('./config.php');
require_once('./Scraper.php');

$id = $_REQUEST['type'];
$name = $_REQUEST['name'];

$url = Config::getFromName($name);

$scraper = new Scraper($url);
$scraper->load();

$cache = $scraper->getData();

$data = array();
switch($id) {
case Scraper::TYPE_NEW_LIKES_PER_WEEK:
	$data = $cache[Scraper::KEY_NEW_LIKES_PER_WEEK];
	break;
case Scraper::TYPE_PEOPLE_TALKING_ABOUT_THIS:
	$data = $cache[Scraper::KEY_NEW_LIKES_PER_WEEK];
	break;
case Scraper::TYPE_TOTAL_LIKES:
	$data = $cache[Scraper::KEY_TOTAL_LIKES];
	break;
case Scraper::TYPE_TOTAL_TALK:
	$data = $cache[Scraper::KEY_TOTAL_TALK];
	break;
default:
	throw new Exception('type parameter is invalid.');
}

header('Content-type: text/plain; charset=utf-8');
//print "Date\tCount\n";
foreach ($data as $time => $count) {
	print sprintf("%s\t%s\n", date('Y-m-d', $time), $count);
}

