<?php
error_reporting(E_ALL ^E_NOTICE);
/**
 * Config file for facebook page tracking
 *
 * @author Yuki Matsukura <matsubokkuri@gmail.com>
 * @version 1.0
 */
/**
 * Sample class
 *
 */
class Config
{
    private static $url = array(
        // url is invalid.
//            'Rage of Bahamut' => 'https://www.facebook.com/pages/Rage-of-Bahamut/258363937574729?id=258363937574729&sk=likes',
            'GREE'            => 'https://www.facebook.com/GREEofficial/likes',
            'Pirates Age'     => 'https://www.facebook.com/GREE.PiratesAge.en/likes',
            'Crime City'      => 'https://www.facebook.com/crimecity/likes',
            'GREE Games'      => 'https://www.facebook.com/GREEGames/likes',
            'Career at GREE'  => 'https://www.facebook.com/gree.careers.jp/likes',
            'GREE Tech'       => 'https://www.facebook.com/GREE.pr.tech.jp/likes',
            '不良道'          => 'https://www.facebook.com/pages/%E4%B8%8D%E8%89%AF%E9%81%93-%E3%82%AE%E3%83%A3%E3%83%B3%E3%82%B0%E3%83%AD%E3%83%BC%E3%83%89/401324046623750?id=401324046623750&sk=likes',
            'パズドラ'        => 'https://www.facebook.com/Pazudorakouryaku/likes',
            'Matsubo X Web'   => 'https://www.facebook.com/matsubokkuringo/likes',
            'テラレン！'      => 'https://www.facebook.com/teraren/likes',
            'Galaxy Life : Pocket Adventures'   => 'https://www.facebook.com/GalaxyLifePocketAdventures/likes',
            'ユナイテッドアローズ グリーンレーベル リラクシング'   => 'https://www.facebook.com/UA.glr/likes',
            'ONE PIECE'         => 'https://www.facebook.com/oppirates/likes',
            'anime-bookmark'    => 'https://www.facebook.com/anime.bookmark/likes',
            'Facebook Japan'    => 'https://www.facebook.com/FacebookJapan/likes',
            'Facebook navi'     => 'https://www.facebook.com/fnavigation/likes',
            'satisfaction guaranteed'     => 'https://www.facebook.com/japan.satisfactionguaranteed/likes',
            'ParGolf / パーゴルフ' => 'https://www.facebook.com/pargolfonline/likes',
            'BAD LAND' => 'https://www.facebook.com/BADLAND.Japan/likes',
            'Pairs - ペアーズ' => 'https://www.facebook.com/pairs.lv/likes',
            '楽天市場（Rakuten, Inc.）' => 'https://www.facebook.com/RakutenIchiba/likes',
            'サッカー日本代表' => 'https://www.facebook.com/samuraiblue/likes',
            'Music on Facebook Japan' => 'https://www.facebook.com/MoFBJ/likes',
            'ソフトバンク（SoftBank）' => 'https://www.facebook.com/SoftBank/likes',
            'tickit' => 'https://www.facebook.com/tickit.creyle/likes',

        );
    /**
     * getURLArray
     *
     * @static
     * @access public
     * @return void
     */
    public static function getURLArray()
    {
        return self::$url;
    }

    /**
     * getFromName
     *
     * @param mixed $name
     * @static
     * @access public
     * @return void
     */
    public static function getFromName($name)
    {
        return self::$url[$name];
    }
    public static function isValid($name)
    {
        return isset(self::$url[$name]) ? true : false;
    }


}
