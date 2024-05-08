<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class MenuController
{
    public function __construct(private TemplateEngine $view)
    {
    }

    public function menuView()
    {
        echo $this->view->render("/mainMenu.php");
    }
}
