<?php

/**
 * Created by PhpStorm.
 * User: nekrasov
 * Date: 05.12.15
 * Time: 1:39
 */
namespace Curl;

class GoogleCurl extends Curl
{
    protected $query;
    protected $page = 0;
    private $urlBase = 'https://www.google.com.ua/search';

    public function __construct()
    {
        parent::__construct();
    }

    public function setQuery($query)
    {

        $this->query = str_replace(' ', '+', $query);
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function setGooglePage($page, $pagelimit = 10)
    {
        $this->page = ($page - 1) * $pagelimit;
    }

    public function getGooglePage()
    {
        return $this->page;
    }

    public function getResult()
    {
        $url = $this->urlBase . '?q=' . $this->getQuery();

        if ($page = $this->getGooglePage()) {
            $url .= '&start=' . $page;
        }

        $result = $this->execute($url);

        return $result;
    }
}