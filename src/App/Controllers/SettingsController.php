<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\{UserService, ValidatorService};
use Framework\TemplateEngine;

class SettingsController
{
    public function __construct(
        private TemplateEngine $view,
        private UserService $userService,
        private ValidatorService $validatorService
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
        echo $this->view->render(
            'settings/incomeCategories.php',
            [
                'categories' => $userSettings['incomesCategory']
            ]
        );
    }
}
