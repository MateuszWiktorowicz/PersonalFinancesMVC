<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
    public function __construct(private Database $db)
    {
    }

    public function isEmailTaken(string $email)
    {
        $emailCount = $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email = :email",
            [
                'email' => $email
            ]
        )->count();

        if ($emailCount > 0) {
            throw new ValidationException(['email' => ["Email taken"]]);
        }
    }

    public function isEmailTakenWhenUpdateUser(string $email)
    {
        $emailCount = $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email = :email AND id != :id",
            [
                'email' => $email,
                'id' => $_SESSION['user']
            ]
        )->count();

        if ($emailCount > 0) {
            throw new ValidationException(['email' => ["Email taken"]]);
        }
    }

    public function create(array $formData)
    {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]);
        $this->db->query(
            "INSERT INTO users(username,email,password) VALUES(:name, :email, :password)",
            [
                'name' => $formData['name'],
                'email' => $formData['email'],
                'password' => $password,
            ]
        );

        session_regenerate_id();

        $_SESSION['user'] = $this->db->id();

        $this->assignDefaultSettingToNewUser(intval($_SESSION['user']));
    }

    private function assignDefaultSettingToNewUser()
    {
        $tables = [
            'expenses_category_assigned_to_users' => 'expenses_category_default',
            'incomes_category_assigned_to_users' => 'incomes_category_default',
            'payment_methods_assigned_to_users' => 'payment_methods_default'
        ];

        foreach ($tables as $assignedTable => $defaultTable) {
            $this->db->query(
                "INSERT INTO $assignedTable (user_id, name) SELECT :user_id, name FROM $defaultTable",
                ['user_id' => $_SESSION['user']]
            );
        }
    }

    public function getUserSettings()
    {
        session_regenerate_id();

        $user_id = $_SESSION['user'];



        $expensesCategory = $this->db->query(
            "SELECT * FROM expenses_category_assigned_to_users WHERE user_id = :user_id",
            [
                'user_id' => $user_id
            ]
        )->findAll();

        $incomesCategory = $this->db->query(
            "SELECT * FROM incomes_category_assigned_to_users WHERE user_id = :user_id",
            [
                'user_id' => $user_id
            ]
        )->findAll();

        $paymentMethods = $this->db->query(
            "SELECT * FROM payment_methods_assigned_to_users WHERE user_id = :user_id",
            [
                'user_id' => $user_id
            ]
        )->findAll();

        return [
            'incomesCategory' => $incomesCategory,
            'expensesCategory' => $expensesCategory,
            'paymentMethods' => $paymentMethods
        ];
    }


    public function login(array $formData)
    {
        $user = $this->db->query("SELECT * FROM users WHERE email = :email", [
            'email' => $formData['email']
        ])->find();

        $passwordMatch = password_verify(
            $formData['password'],
            $user['password'] ?? ''
        );
        if (!$user || !$passwordMatch) {
            throw new ValidationException(['password' => ['Invalid credentials']]);
        }

        session_regenerate_id();

        $_SESSION['user'] = $user['id'];
    }

    public function logout()
    {
        unset($_SESSION['user']);

        session_regenerate_id();

        $params = session_get_cookie_params();

        setcookie(
            "PHPSESSID",
            '',
            time() - 3600,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    public function updateUser(array $formData, int $id)
    {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]);
        $this->db->query(
            "UPDATE users
            SET
            username = :name,
            email = :email,
            password = :password
            WHERE
            id = :id",
            [
                'name' => $formData['name'],
                'email' => $formData['email'],
                'password' => $password,
                'id' => $id
            ]
        );
    }

    public function getUser()
    {
        return $this->db->query(
            "SELECT id, username, email FROM users WHERE id = :id",
            [
                'id' => $_SESSION['user']
            ]
        )->find();
    }

    public function isCategoryAssigned(string $categoryName)
    {
        $categoryCount = $this->db->query(
            "SELECT COUNT(*) AS count FROM incomes_category_assigned_to_users WHERE user_id = :id AND UPPER(name) = UPPER(:categoryName)",
            [
                'id' => $_SESSION['user'],
                'categoryName' => $categoryName
            ]
        )->count();

        if ($categoryCount > 0) {
            throw new ValidationException(['category' => ['Category already assigned to Your account']]);
        }
    }

    public function addIncomeCategory(array $dataForm)
    {
        $this->db->query(
            "INSERT INTO incomes_category_assigned_to_users(user_id, name) VALUES(:id, :categoryName);",
            [
                'id' => $_SESSION['user'],
                'categoryName' => $dataForm['category']
            ]
        );
    }

    public function deleteIncomeCategory(int $id)
    {
        $this->db->query(
            "DELETE FROM incomes_category_assigned_to_users WHERE id = :id AND user_id = :user_id",
            [
                'id' => $id,
                'user_id' => $_SESSION['user']
            ]
        );
    }

    public function updateIncomeCategory(array $formData, int $id)
    {
        $this->db->query(
            "UPDATE incomes_category_assigned_to_users
            SET
            name = :name
            WHERE
            user_id = :user_id
            AND
            id = :id",
            [
                'user_id' => $_SESSION['user'],
                'id' => $id,
                'name' => $formData['category']
            ]
        );
    }
}
