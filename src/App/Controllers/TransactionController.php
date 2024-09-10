<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{TransactionService, ValidatorService, UserService};

class TransactionController
{
    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService,
        private ValidatorService $validatorService,
        private UserService $userService
    ) {}

    public function createIncome()
    {
        $this->validatorService->validateIncomeTranstaction($_POST);
        $this->transactionService->createIncome($_POST);
        redirectTo('/mainMenu');
    }

    public function createExpense()
    {
        $this->validatorService->validateExpenseTranstaction(($_POST));
        $this->transactionService->createExpense($_POST);
        redirectTo('/mainMenu');
    }

    public function editView(array $params)
    {
        $transaction = $this->transactionService->getUserTransaction($params['transaction'], $params['type']);
        $userSettings = $this->userService->getUserSettings();

        if (!$transaction) {
            redirectTo('/');
        }

        if ($transaction['type'] === "Income") {
            echo $this->view->render('transactions/editIncome.php', [
                'transaction' => $transaction,
                'incomesCategory' => $userSettings['incomesCategory']
            ]);
        } elseif ($transaction['type'] === "Expense") {
            echo $this->view->render('transactions/editExpense.php', [
                'transaction' => $transaction,
                'expensesCategory' => $userSettings['expensesCategory'],
                'paymenthMethods' => $userSettings['paymentMethods']
            ]);
        }
    }

    public function edit(array $params)
    {
        $transaction = $this->transactionService->getUserTransaction($params['transaction'], $params['type']);

        if (!$transaction) {
            redirectTo('mainMenu');
        }

        if ($transaction['type'] === "Income") {

            $this->validatorService->validateIncomeTranstaction($_POST);

            $this->transactionService->updateIncome($_POST, $transaction['id']);
        } elseif ($transaction['type'] === "Expense") {

            $this->validatorService->validateExpenseTranstaction($_POST);

            $this->transactionService->updateExpense($_POST, $transaction['id']);
        }


        redirectTo('mainMenu');
    }

    public function delete(array $params)
    {
        $this->transactionService->delete((int) $params['transaction'], $params['type']);

        redirectTo('/');
    }

    public function getLimit(array $params)
    {
        echo json_encode($this->transactionService->getCategoryLimit((string) $params['category']));
    }

    public function getExpensesFromCategory(array $params)
    {
        $date = $params['date'];

        $dates =  getFirstAndLastDayOfMonthFromDate($date);

        echo json_encode($this->transactionService->getExpensesFromCategoryFromPeriod((string) $params['category'], (string) $dates['firstDay'], (string) $dates['lastDay']), JSON_UNESCAPED_UNICODE);
    }
}
