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
        $this->userService->updateUser($_POST, $_SESSION['user']);

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
        $this->userService->isCategoryAssigned($_POST['category']);
        $this->userService->addIncomeCategory($_POST);

        redirectTo('/incomeCategories');
    }

    public function deleteIncomeCategory(array $params)
    {

        $this->userService->deleteIncomeCategory((int) $params['category']);
        redirectTo('/');
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
        $this->userService->isCategoryAssigned($_POST['category']);
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
}
