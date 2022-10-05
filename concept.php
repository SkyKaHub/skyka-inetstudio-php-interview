<?php
class secretKey
{
    private static $instance;
    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getKey() {
        //Берём ключ из внешнего источника( сессия, БД или др.)
        return '123';
    }
    private function __construct()
    {
    }
    private function __clone()
    {
    }
    private function __sleep()
    {
    }
    private function __wakeup()
    {
    }
}


class Concept {
    private $client;
    private $secretKey;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
        $this->secretKey = secretKey::getInstance();
    }

    public function getUserData() {
        $params = [
            'auth' => ['user', 'pass'],
            'token' => $this->getSecretKey()
        ];
        $request = new \Request('GET', 'https://api.method', $params);
        $promise = $this->client->sendAsync($request)->then(function ($response) {
            $result = $response->getBody();
        });

        $promise->wait();
    }
    
    private function getSecretKey() {
        return $this->secretKey->getKey();
    }
}

$test = new Concept();
$test->getUserData();