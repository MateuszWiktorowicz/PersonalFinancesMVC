<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{TransactionService, ValidatorService};

class TransactionController
{
    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService,
        private ValidatorService $validatorService
    ) {
    }

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
}
