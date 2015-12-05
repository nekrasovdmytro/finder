<?php
/**
 * Created by PhpStorm.
 * User: nekrasov
 * Date: 05.12.15
 * Time: 1:53
 */

include 'vendor/autoload.php';

use Curl\GoogleCurl;
use Google\Parser\Url\Url as GoogleUrlParser;

$googleCurl = new GoogleCurl();
$googleCurl->setQuery("love and love");
//$googleCurl->setGooglePage(7);

//echo $googleCurl->getResult(); exit();

$googleUrlParser = new GoogleUrlParser($googleCurl);
$links = $googleUrlParser->getUrlArray();

print_r($links);