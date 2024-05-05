<?php

declare(strict_types=1);

namespace Framework;

use Framework\Router;

class App
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function Run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($path, $method);
    }

    public function getMethod(string $path,  array $controller)
    {
        $this->router->addRoute('GET', $path, $controller);
    }
}
