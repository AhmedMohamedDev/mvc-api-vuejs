<?php

namespace App\Routes;

use App\Controllers\ProductController;
use League\Route\Router;

class Web
{
    public $router;
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function mapRoutes()
    {

        $this->router->map('POST', '/api/v1/product',   [ProductController::class, 'storeProduct']);
        $this->router->map('DELETE', '/api/v1/product', [ProductController::class, 'deleteProduct']);
        $this->router->map('GET', '/api/v1/product',    [ProductController::class, 'show']);
        $this->router->map('GET', '/api/v1/products', [ProductController::class, 'all']);
    }
}
