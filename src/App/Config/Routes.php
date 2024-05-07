<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\{HomeController, AuthController};
use Framework\App;

function registerRoutes(App $app)
{
    $app->getMethod('/', [HomeController::class, 'home']);
    $app->getMethod('/register', [AuthController::class, 'registerView']);
    $app->getMethod('/login', [AuthController::class, 'loginView']);
    $app->post('/register', [AuthController::class, 'register']);
}
