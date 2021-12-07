<?php

namespace Engine;

class Router
{
    public string $method;

    public string $uri;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = strtok($_SERVER['REQUEST_URI'], '?');
    }

    public function get(string $uri, callable $callback): void
    {
        if ($this->uri == $uri) {
            if ($this->method == 'GET') {
                $callback();
            }
        }
    }

    public function post(string $uri, callable $callback): void
    {
        if ($this->uri == $uri) {
            if ($this->method == 'POST') {
                $callback();
            }
        }
    }
}