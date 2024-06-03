<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\{TransactionService, UserService, ValidatorService};
use Framework\TemplateEngine;

class SettingsController
{
    public function __construct(
        private TemplateEngine $view,
        private UserService $userService,
        private ValidatorService $validatorService,
        private TransactionService $transactionService
    ) {
    }


    public function updateUserView()
    {
        $user = $this->userService->getUser();

        echo $this->view->render(
            '/settings/updateUser.php',
            [
                'user' => $user
            ]
        );
    }

    public function updateUser()
    {
        $this->validatorService->validateRegister($_POST);
        $this->userService->isEmailTakenWhenUpdateUser($_POST['email']);
        $this->userService->updateUser($_POST, (int) $_SESSION['user']);

        redirectTo('/logout');
    }

    public function editIncomeCategoriesView()
    {
        $userSettings = $this->userService->getUserSettings();

        $categories = [];

        foreach ($userSettings['incomesCategory'] as $category) {
            $transactionsNo = $this->transactionService->countIncomesByCategory((int) $category['id']);

            $category['transactionNo'] = $transactionsNo;
            $categories[] = $category;
        }


        echo $this->view->render(
            'settings/incomeCategories.php',
            [
                'categories' => $categories
            ]
        );
    }

    public function addIncomeCategory()
    {
        $this->validatorService->validateNewCategory($_POST);
        $this->userService->isIncomeCategoryAssigned($_POST['category']);
        $this->userService->addIncomeCategory($_POST);

        redirectTo('/incomeCategories');
    }

    public function deleteIncomeCategory(array $params)
    {

        $this->userService->deleteIncomeCategory((int) $params['category']);
        redirectTo('/incomeCategories');
    }

    public function editIncomeCategoryView(array $params)
    {
        $id = $params['category'];
        $userSettings = $this->userService->getUserSettings();
        $incomesCategory = $userSettings['incomesCategory'];

        $matchedCategory = array_values(array_filter($incomesCategory, function ($category) use ($id) {
            return $category['id'] == $id;
        }));



        echo $this->view->render(
            'settings/incomeCategoryEdit.php',
            [
                'category' => $matchedCategory
            ]
        );
    }

    public function editIncomeCategory(array $params)
    {
        $this->validatorService->validateNewCategory($_POST);
        $this->userService->isIncomeCategoryAssigned($_POST['category']);
        $this->userService->updateIncomeCategory($_POST, (int) $params['category']);

        redirectTo('/incomeCategories');
    }

    public function viewCategoryIncomeTransactions(array $params)
    {
        $transactions = $this->transactionService->selectIncomesByCategory((int) $params['category']);

        echo $this->view->render(
            "/settings/incomesByCategory.php",
            [
                'transactions' => $transactions

            ]
        );
    }

    public function editExpenseCategoriesView()
    {
        $userSettings = $this->userService->getUserSettings();

        $categories = [];

        foreach ($userSettings['expensesCategory'] as $category) {
            $transactionsNo = $this->transactionService->countExpensesByCategory((int) $category['id']);

            $category['transactionNo'] = $transactionsNo;
            $categories[] = $category;
        }


        echo $this->view->render(
            'settings/expenseCategories.php',
            [
                'categories' => $categories
            ]
        );
    }

    public function addExpenseCategory()
    {
        $this->validatorService->validateNewCategory($_POST);
        $this->userService->isExpenseCategoryAssigned($_POST['category']);
        $this->userService->addExpenseCategory($_POST);

        redirectTo('/expenseCategories');
    }

    public function editExpenseCategoryView(array $params)
    {
        $id = $params['category'];
        $userSettings = $this->userService->getUserSettings();
        $expensesCategory = $userSettings['expensesCategory'];

        $matchedCategory = array_values(array_filter($expensesCategory, function ($category) use ($id) {
            return $category['id'] == $id;
        }));



        echo $this->view->render(
            'settings/expenseCategoryEdit.php',
            [
                'category' => $matchedCategory
            ]
        );
    }

    public function editExpenseCategory(array $params)
    {
        $this->validatorService->validateNewCategory($_POST);
        $this->userService->isExpenseCategoryAssigned($_POST['category']);
        $this->userService->updateExpenseCategory($_POST, (int) $params['category']);

        redirectTo('/expenseCategories');
    }

    public function deleteExpenseCategory(array $params)
    {

        $this->userService->deleteExpenseCategory((int) $params['category']);
        redirectTo('/expenseCategories');
    }

    public function viewCategoryExpenseTransactions(array $params)
    {
        $transactions = $this->transactionService->selectExpensesByCategory((int) $params['category']);

        echo $this->view->render(
            "/settings/expensesByCategory.php",
            [
                'transactions' => $transactions

            ]
        );
    }

    public function editPaymentMethodsView()
    {
        $userSettings = $this->userService->getUserSettings();

        $categories = [];

        foreach ($userSettings['paymentMethods'] as $category) {
            $transactionsNo = $this->transactionService->countExpensesByPaymentMethod((int) $category['id']);

            $category['transactionNo'] = $transactionsNo;
            $categories[] = $category;
        }


        echo $this->view->render(
            'settings/paymentMethods.php',
            [
                'categories' => $categories
            ]
        );
    }

    public function addPaymentMethod()
    {
        $this->validatorService->validateNewCategory($_POST);
        $this->userService->isPaymentMethodAssigned($_POST['category']);
        $this->userService->addPaymentMethod($_POST);

        redirectTo('/paymentMethods');
    }

    public function deletePaymentMethod(array $params)
    {

        $this->userService->deletePaymentMethods((int) $params['category']);
        redirectTo('/paymentMethods');
    }

    public function editPaymentMethodView(array $params)
    {
        $id = $params['category'];
        $userSettings = $this->userService->getUserSettings();
        $paymentMethods = $userSettings['paymentMethods'];

        $matchedCategory = array_values(array_filter($paymentMethods, function ($category) use ($id) {
            return $category['id'] == $id;
        }));



        echo $this->view->render(
            'settings/paymentMethodEdit.php',
            [
                'category' => $matchedCategory
            ]
        );
    }
    public function editPaymentMethod(array $params)
    {
        $this->validatorService->validateNewCategory($_POST);
        $this->userService->isPaymentMethodAssigned($_POST['category']);
        $this->userService->updatePaymentMethod($_POST, (int) $params['category']);

        redirectTo('/paymentMethods');
    }

    public function viewExpensesByPaymentMethod(array $params)
    {
        $transactions = $this->transactionService->selectExpensesByPaymentMethods((int) $params['category']);

        echo $this->view->render(
            "/settings/expensesByPaymentMethod.php",
            [
                'transactions' => $transactions

            ]
        );
    }
}
