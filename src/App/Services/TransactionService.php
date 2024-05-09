<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{
    public function __construct(private Database $db)
    {
    }

    public function createIncome(array $formData)
    {
        $formattedDate = "{$formData['date']} 00:00:00";

        $this->db->query(
            "INSERT INTO incomes(user_id, income_category_assigned_to_user_id, amount, date_of_income, income_comment) VALUES (:user_id, :income_category_assigned_to_user_id, :amount, :date_of_income, :income_comment)",
            [
                'user_id' => $_SESSION['user'],
                'income_category_assigned_to_user_id' => $formData['category'],
                'amount' => $formData['amount'],
                'date_of_income' => $formattedDate,
                'income_comment' => $formData['description']
            ]
        );
    }

    public function createExpense(array $formData)
    {
        $formattedDate = "{$formData['date']} 00:00:00";

        $this->db->query(
            "INSERT INTO expenses(user_id, expense_category_assigned_to_user_id, payment_method_assigned_to_user_id, amount, date_of_expense, expense_comment) VALUES (:user_id, :expense_category_assigned_to_user_id, :payment_method_assigned_to_user_id, :amount, :date_of_expense, :expense_comment)",
            [
                'user_id' => $_SESSION['user'],
                'expense_category_assigned_to_user_id' => $formData['category'],
                'payment_method_assigned_to_user_id' => $formData['paymentMethod'],
                'amount' => $formData['amount'],
                'date_of_expense' => $formattedDate,
                'expense_comment' => $formData['description']
            ]
        );
    }
}
