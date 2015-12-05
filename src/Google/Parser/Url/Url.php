<?php
/**
 * Created by PhpStorm.
 * User: nekrasov
 * Date: 05.12.15
 * Time: 2:21
 */

namespace Google\Parser\Url;


use Curl\GoogleCurl;
use Google\Parser\GoogleParserException;

class Url
{
    protected $googleCurl;

    public function __construct(GoogleCurl $googleCurl)
    {
        $this->googleCurl = $googleCurl;
    }

    public function getUrlArray()
    {
        try {
            $result = $this->googleCurl->getResult();
            preg_match_all('#<h3[^>]+>(.+?)</h3>#ims', $result, $matches);

            if (!isset($matches[0]) || !count($matches[0])) {
                throw new GoogleParserException('Query: ' . $this->googleCurl->getQuery() .', page: ' .$this->googleCurl->getGooglePage(). ' is given empty result');
            }

            $urls = [];

            foreach ($matches[0] as $match) {
                try {
                    preg_match('/<a href="(.+)">/', $match, $url);

                    if (isset($url[1])) {
                        $currentUrl = $this->parseLinkUrl($url[1]);

                        if (strpos($currentUrl, 'google') !== false) {
                            throw new GoogleParserException($currentUrl . ' - google url');
                        }

                        $urls[] = $currentUrl;
                    }
                } catch (GoogleParserException $e) {
                    echo $e->getMessage();
                }
            }

            return $urls;

        } catch(GoogleParserException $e){
            echo $e->getMessage();
        }

    }

    protected function parseLinkUrl($url)
    {
        try {
            $urlParams = mb_substr($url, mb_strpos($url, '?') + 1);
            $array = [];

            mb_parse_str(htmlspecialchars_decode($urlParams), $array);

            if (!filter_var($array['q'], FILTER_VALIDATE_URL)) {
                throw new GoogleParserException($array['q']. ' invalid url');
            }

            return $array['q'];

        } catch (GoogleParserException $e) {
            throw $e;
        }
    }
}