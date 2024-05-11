<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{UserService, TransactionService};


class MenuController
{
    private array $userSettings = [];

    public function __construct(
        private TemplateEngine $view,
        private UserService $userService,
        private TransactionService $transactionService

    ) {
        $this->userSettings = $this->userService->getUserSettings();
    }

    public function menuView()
    {
        $transactions = $this->transactionService->getUserTransactions();
        $balance = $this->transactionService->getUserTotalBalance();


        echo $this->view->render("/mainMenu.php", [
            'transactions' => $transactions,
            'balance' => $balance
        ]);
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





        echo $this->view->render(
            "/balance.php",
            [
                'transactions' => $this->transactionService->getUserTransactionsFromPeriod('2024-05-11', '2024-05-30'),
                'totalIncomes' => $this->transactionService->countIncomesFromPeriod('2024-05-11', '2024-05-30'),
                'totalExpenses' => $this->transactionService->countExpensesFromPeriod('2024-05-11', '2024-05-30'),
                'balance' => $this->transactionService->countBalanceFromPeriod('2024-05-11', '2024-05-30')
            ]
        );
    }

    public function settingsView()
    {
        echo $this->view->render("/settings.php");
    }

    public function getBalance()
    {
        $period = $_POST['period'];


        switch ($period) {
            case 'currentMonth':
                $this->balanceView();
                break;
            case "lastMonth":
                $this->balanceView();
                break;
            case "currentYear":
                $this->balanceView();
                break;
            case 'custom':

                break;
        }
    }
}
