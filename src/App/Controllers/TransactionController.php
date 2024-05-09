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
        $this->validatorService->validateTranstaction($_POST);
        $this->transactionService->createIncome($_POST);
        redirectTo('/income');
    }
}
