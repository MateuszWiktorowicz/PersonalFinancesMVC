<?php

declare(strict_types=1);

include __DIR__ . "/../../vendor/autoload.php";

use Framework\App;
use App\Controllers\HomeController;

$app = new App();

$app->getMethod('/', [HomeController::class, 'home']);

return $app;
