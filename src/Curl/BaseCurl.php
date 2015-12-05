<?php

/**
 * Created by PhpStorm.
 * User: nekrasov
 * Date: 05.12.15
 * Time: 1:30
 */
namespace Curl;

class BaseCurl
{
    protected $ch;

    public function __construct()
    {
        $this->ch = curl_init();
    }

    public function execute($url)
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt ($this->ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.17) Gecko/2009122116 Firefox/3.0.17");
        $headers = [
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*;q=0.8',
            'Accept-Language: ru,en-us;q=0.7,en;q=0.3',
            'Accept-Charset: windows-1251, utf-8;q=0.7,*;q=0.7'
        ];
        curl_setopt($this->ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($this->ch);

        return $result;
    }
}