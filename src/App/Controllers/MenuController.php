<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{UserService, TransactionService, ValidatorService};


class MenuController
{


    public function __construct(
        private TemplateEngine $view,
        private UserService $userService,
        private TransactionService $transactionService,
        private ValidatorService $validatorService

    ) {
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
        $userSettings = $this->userService->getUserSettings();

        echo $this->view->render(
            "/income.php",
            [
                'incomesCategory' => $userSettings['incomesCategory']
            ]
        );
    }

    public function expenseView()
    {
        $userSettings = $this->userService->getUserSettings();

        echo $this->view->render("/expense.php", [
            'expensesCategory' => $userSettings['expensesCategory'],
            'paymenthMethods' => $userSettings['paymentMethods']
        ]);
    }

    public function balanceView()
    {
        if (isset($_GET['period'])) {
            $period = $_GET['period'];
        } else {
            $period = 'currentMonth';
        }

        if ((isset($_GET['startDate'])) && (isset($_GET['endDate']))) {
            $this->validatorService->validateCustomDates($_GET);
            echo $this->view->render(
                "/balance.php",
                $this->templateData($_GET['startDate'], $_GET['endDate'])
            );
        } elseif ($period !== 'custom') {
            $dates = getPeriodDates($period);

            echo $this->view->render(
                "/balance.php",
                $this->templateData($dates['startDate'], $dates['endDate'])
            );
        } else {
            echo $this->view->render("/customBalance.php");
        }
    }

    public function settingsView()
    {
        echo $this->view->render("/settings/settings.php");
    }

    private function templateData(string $startDate, string $endDate)
    {
        return [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'transactions' => $this->transactionService->getUserTransactionsFromPeriod($startDate, $endDate),
            'totalIncomes' => $this->transactionService->countIncomesFromPeriod($startDate, $endDate),
            'totalExpenses' => $this->transactionService->countExpensesFromPeriod($startDate, $endDate),
            'balance' => $this->transactionService->countBalanceFromPeriod($startDate, $endDate),
            'incomesCategoryBalance' => $this->transactionService->getIncomesBalanceByCategoryNameFromPeriod($startDate, $endDate),
            'expensesCategoryBalance' => $this->transactionService->getExpensesBalanceByCategoryNameFromPeriod($startDate, $endDate)
        ];
    }
}
