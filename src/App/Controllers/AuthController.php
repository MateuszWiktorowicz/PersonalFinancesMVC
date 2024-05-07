<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\{ValidatorService, UserService};
use Framework\TemplateEngine;

class AuthController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
    ) {
    }

    public function registerView()
    {
        echo $this->view->render("register.php");
    }

    public function loginView()
    {
        echo $this->view->render("login.php");
    }

    public function register()
    {

        $this->validatorService->validateRegister($_POST);


        redirectTo('/');
    }

    public function login()
    {
        $this->validatorService->validateLogin($_POST);

        redirectTo('/');
    }

    public function logout()
    {


        redirectTo('/login');
    }
}
