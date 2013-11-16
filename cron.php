<?php
/**
 * Example:
 * 0 2    * * * cd /home/yuki-matsukura/gree/facebook/page_tracking && php cron.php > /tmp/cron.txt 2>&1   
 */
require_once('./config.php');
require_once('./Scraper.php');


foreach (Config::getURLArray() as $name => $url) {
	print $url."\n";
	$scraper = new Scraper($url);
	$scraper->execute();
}

