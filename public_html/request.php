<?php

require ('cache.php');

class SimpleJsonRequest
{
    private static function makeRequest(string $method, string $url, array $parameters = null, array $data = null)
    {
        $opts = [
            'http' => [
                'method'  => $method,
                'header'  => 'Content-type: application/json',
                'content' => $data ? json_encode($data) : null
            ]
        ];

        $url .= ($parameters ? '?' . http_build_query($parameters) : '');
        $cache = new Cache();
        return $cache->get($url, $opts);
    }

    public static function get(string $url, array $parameters = null)
    {
        return json_decode(self::makeRequest('GET', $url, $parameters));
    }

    public static function post(string $url, array $parameters = null, array $data)
    {
        return json_decode(self::makeRequest('POST', $url, $parameters, $data));
    }

    public static function put(string $url, array $parameters = null, array $data)
    {
        return json_decode(self::makeRequest('PUT', $url, $parameters, $data));
    }   

    public static function patch(string $url, array $parameters = null, array $data)
    {
        return json_decode(self::makeRequest('PATCH', $url, $parameters, $data));
    }

    public static function delete(string $url, array $parameters = null, array $data = null)
    {
        return json_decode(self::makeRequest('DELETE', $url, $parameters, $data));
    }
}

//test page
$test = new SimpleJsonRequest();
$script   = $_SERVER['SCRIPT_NAME'];
$params   = $_SERVER['QUERY_STRING'];
if(!empty($params)) {
    $currentUrl = $script . '?' . $params;
} 
else {
    $currentUrl = $script;
}
$currentUrl = ltrim($currentUrl, "/");
$test->get($currentUrl);