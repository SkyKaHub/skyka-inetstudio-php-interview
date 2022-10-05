<?php

interface XMLHTTPRequestService {
    public function request(string $url, string $type, $options);
}

class XMLHttpService implements XMLHTTPRequestService {
    public function request(string $url, string $type, $options) {
        return 'test';
    }
}

class Http {
    private $service;

    public function __construct(XMLHTTPRequestService $XMLHTTPRequestService) {
        $this->service = $XMLHTTPRequestService;
    }

    public function get(string $url, array $options) {
        $this->service->request($url, 'GET', $options);
    }

    public function post(string $url) {
        $this->service->request($url, 'GET');
    }
}
