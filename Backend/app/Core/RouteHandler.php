<?php

namespace App\Core;

use League\Route\Router;
use Psr\Http\Message\ServerRequestInterface;
use GuzzleHttp\Psr7\ServerRequest;

class RouteHandler
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function map($method, $path, $controller)
    {
        $this->router->map($method, $path, $controller);
    }

    public function run()
    {
        $response = $this->router->dispatch($this->getRequest());
        http_response_code($response->getStatusCode());
        echo $response->getBody();
    }

    protected function getRequest(): ServerRequestInterface
    {
        return ServerRequest::fromGlobals();
    }
}
