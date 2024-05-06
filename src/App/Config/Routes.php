<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\HomeController;

function registerRoutes(App $app)
{
    $app->getMethod('/', [HomeController::class, 'home']);
}
