<?php
/**
 * Facebook page tracker.
 *
 * - todo
 *   - lock the data file
 * - usage
 * <pre>
 * $scraper = new Scraper('http://www.facebook.com/pages/Rage-of-Bahamut/258363937574729?sk=likes');
 * $scraper->execute();
 * </pre>
 *
 * @author Yuki Matsukura <matsubokkuri@gmail.com>
 * @version 1.0
 */
/**
 * Sample class
 *
 */
class Scraper
{

    const TYPE_NEW_LIKES_PER_WEEK = 1;
    const TYPE_PEOPLE_TALKING_ABOUT_THIS = 2;

    const TYPE_TOTAL_LIKES = 3;
    const TYPE_TOTAL_TALK = 4;

    const KEY_NEW_LIKES_PER_WEEK = 'new_likes_per_week';
    const KEY_PEOPLE_TALKING_ABOUT_THIS= 'people_talking_about_this';

    const KEY_TOTAL_LIKES = 'total_likes';
    const KEY_TOTAL_TALK        = 'total_talk';

    const LOG_DIRECTORY = 'log';

    private $url;

    private $data;

    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * load
     *
     * @access private
     * @return void
     */
    public function load()
    {
        if (!is_dir(self::LOG_DIRECTORY)) {
            mkdir(self::LOG_DIRECTORY, 0755);

            return;
        }

        $filename = sha1($this->url);
        $file = self::LOG_DIRECTORY.'/'.$filename;

        if (!is_file($file)) {
            return;
        }

        $this->data = unserialize(file_get_contents($file));
    }

    private function save()
    {
        $filename = sha1($this->url);
        $file = self::LOG_DIRECTORY.'/'.$filename;

        return file_put_contents($file, serialize($this->data));
    }

    /**
     * execute
     *
     * @access public
     * @return array
     */
    public function execute()
    {
        $this->load();

        ini_set('user_agent', 'User-Agent: Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_8; en-US) AppleWebKit/532.5 (KHTML, like Gecko) Chrome/4.0.249.0 Safari/532.5');

        $contents = file_get_contents($this->url);

        $this->getHistoricalData($contents);
        $this->getSummaryData($contents);

        $this->save();
    }

    /**
     * getData
     *
     * @access public
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Load historical data from the web page.
     */
    private function getHistoricalData($contents)
    {
        // like and talk history
        if (preg_match('/PagesLikesTabGraph\(\)\.plotGraph(.*)\)/', $contents, $matches)) {
            $json_string = $matches[1];
            if (preg_match_all('(\[\[[\[\]0-9,]+\]\])', $json_string, $matches_json)) {

                $new_likes_per_week_string = $matches_json[0][0];
                $people_talking_about_this_string = $matches_json[0][1];

                // for like
                $count = 0;
                if (preg_match_all('/([0-9]+),([0-9]+)/', $new_likes_per_week_string, $matches_new_likes)) {

                    foreach ($matches_new_likes[1] as $time) {
                        $time = $time / 1000;
                        $likes = $matches_new_likes[2][$count];
                        $count++;

                        $this->data[self::KEY_NEW_LIKES_PER_WEEK][$time] = $likes;
                    }
                }

                // for talk
                $count = 0;
                if (preg_match_all('/([0-9]+),([0-9]+)/', $people_talking_about_this_string, $matches_talk)) {

                    foreach ($matches_talk[1] as $time) {
                        $time = $time / 1000;
                        $likes = $matches_talk[2][$count];
                        $count++;

                        $this->data[self::KEY_PEOPLE_TALKING_ABOUT_THIS][$time] = $likes;
                    }
                }
            }
        }
    }

    /**
     * getSummaryData
     *
     * @param mixed $contents
     * @access private
     * @return void
     */
    private function getSummaryData($contents)
    {
        if (preg_match_all('/<span class="timelineLikesBigNumber fsm">([0-9,]+)<\/span>/', $contents, $matches)) {
            $talk  = $matches[1][0];
            $likes = $matches[1][1];

            $today = strtotime(date('Y-m-d'));
            $this->data[self::KEY_TOTAL_LIKES][$today] = str_replace(',', '', $likes);
            $this->data[self::KEY_TOTAL_TALK][$today]  = str_replace(',', '', $talk);
        }
    }

}
