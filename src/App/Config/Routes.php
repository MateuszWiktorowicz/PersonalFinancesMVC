<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\{HomeController, AuthController, MenuController, SettingsController, TransactionController};
use Framework\App;
use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware};

function registerRoutes(App $app)
{
    $app->getMethod('/', [HomeController::class, 'home'])->add(GuestOnlyMiddleware::class);
    $app->getMethod('/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
    $app->getMethod('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    $app->getMethod('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
    $app->getMethod('/mainMenu', [MenuController::class, 'menuView'])->add(AuthRequiredMiddleware::class);
    $app->getMethod('/income', [MenuController::class, 'incomeView'])->add(AuthRequiredMiddleware::class);
    $app->getMethod('/expense', [MenuController::class, 'expenseView'])->add(AuthRequiredMiddleware::class);
    $app->getMethod('/balance', [MenuController::class, 'balanceView'])->add(AuthRequiredMiddleware::class);
    $app->getMethod('/settings', [MenuController::class, 'settingsView'])->add(AuthRequiredMiddleware::class);
    $app->post('/income', [TransactionController::class, 'createIncome'])->add(AuthRequiredMiddleware::class);
    $app->post('/expense', [TransactionController::class, 'createExpense'])->add(AuthRequiredMiddleware::class);
    $app->getMethod('/transaction/{type}/{transaction}', [TransactionController::class, "editView"])->add(AuthRequiredMiddleware::class);
    $app->post('/transaction/{type}/{transaction}', [TransactionController::class, "edit"])->add(AuthRequiredMiddleware::class);
    $app->delete('/transaction/{type}/{transaction}', [TransactionController::class, "delete"])->add(AuthRequiredMiddleware::class);
    $app->getMethod('/updateUser', [SettingsController::class, "updateUserView"])->add(AuthRequiredMiddleware::class);
    $app->post('/updateUser', [SettingsController::class, "updateUser"])->add(AuthRequiredMiddleware::class);
    $app->getMethod('/incomeCategories', [SettingsController::class, "editIncomeCategoriesView"])->add(AuthRequiredMiddleware::class);
    $app->post('/incomeCategories', [SettingsController::class, "addIncomeCategory"])->add(AuthRequiredMiddleware::class);
    $app->delete('/incomeCategories/{category}', [SettingsController::class, "deleteIncomeCategory"])->add(AuthRequiredMiddleware::class);
    $app->getMethod('/incomeCategories/{category}', [SettingsController::class, 'editIncomeCategoryView'])->add(AuthRequiredMiddleware::class);
    $app->post('/incomeCategories/{category}', [SettingsController::class, "editIncomeCategory"])->add(AuthRequiredMiddleware::class);
}
