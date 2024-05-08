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

    public function incomeView()
    {
        echo $this->view->render("/income.php");
    }

    public function expenseView()
    {
        echo $this->view->render("/expense.php");
    }

    public function balanceView()
    {
        echo $this->view->render("/balance.php");
    }

    public function settingsView()
    {
        echo $this->view->render("/settings.php");
    }
}
