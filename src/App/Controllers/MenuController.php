<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\UserService;


class MenuController
{
    private array $userSettings = [];

    public function __construct(
        private TemplateEngine $view,
        private UserService $userService

    ) {
        $this->userSettings = $this->userService->getUserSettings();
    }

    public function menuView()
    {
        echo $this->view->render("/mainMenu.php");
    }

    public function incomeView()
    {

        echo $this->view->render(
            "/income.php",
            [
                'incomesCategory' => $this->userSettings['incomesCategory']
            ]
        );
    }

    public function expenseView()
    {
        echo $this->view->render("/expense.php", [
            'expensesCategory' => $this->userSettings['expensesCategory'],
            'paymenthMethods' => $this->userSettings['paymentMethods']
        ]);
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
