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

    public function getUserTransactions()
    {
        $transactions = $this->db->query(
            "SELECT 
            expenses.amount AS amount,
            ec.name AS category,
            pm.name AS paymentMethod,
            expenses.date_of_expense AS date,
            expenses.expense_comment AS comment,
            'Expense' AS type
        FROM 
            expenses
            INNER JOIN expenses_category_assigned_to_users AS ec ON ec.id = expenses.expense_category_assigned_to_user_id
            INNER JOIN payment_methods_assigned_to_users AS pm ON pm.id = expenses.payment_method_assigned_to_user_id
        WHERE 
            expenses.user_id = :user_id
        UNION ALL
        SELECT 
            incomes.amount AS amount,
            ic.name AS category,
            '-' AS paymentMethod,
            incomes.date_of_income AS date,
            incomes.income_comment AS comment,
            'Income' AS type
        FROM 
            incomes
            INNER JOIN incomes_category_assigned_to_users AS ic ON ic.id = incomes.income_category_assigned_to_user_id
        WHERE 
            incomes.user_id = :user_id 
            ORDER BY date DESC",
            [
                'user_id' => $_SESSION['user']
            ]
        )->findAll();

        return $transactions;
    }

    public function getUserTotalBalance()
    {
        $incomes = $this->db->query(
            "SELECT SUM(amount) AS amount FROM incomes WHERE user_id = :user_id",
            [
                'user_id' => $_SESSION['user']
            ]
        )->find();
        $expenses = $this->db->query(
            "SELECT SUM(amount) AS amount FROM expenses WHERE user_id = :user_id",
            [
                'user_id' => $_SESSION['user']
            ]
        )->find();

        return $incomes['amount'] - $expenses['amount'];
    }

    public function getIncomesFromPeriod(string $startDate, string $endDate)
    {
        $startDate = date('Y-m-d', strtotime($startDate));
        $endDate = date('Y-m-d', strtotime($endDate));

        $incomesFromPeriod = $this->db->query(
            "SELECT 
        c.name,
        i.date_of_income AS date,
        i.amount,
        i.income_comment AS comment
    FROM
        incomes AS i
        INNER JOIN incomes_category_assigned_to_users AS c ON i.income_category_assigned_to_user_id = c.id
    WHERE
        i.date_of_income BETWEEN :startDate AND :endDate
        AND
        i.user_id = :userId
    ORDER BY i.date_of_income",
            [
                'startDate' => $startDate,
                'endDate' => $endDate,
                'userId' => $_SESSION['user']
            ]
        )->findAll();

        return $incomesFromPeriod;
    }

    public function getExpensesFromPeriod(string $startDate, string $endDate)
    {
        $startDate = date('Y-m-d', strtotime($startDate));
        $endDate = date('Y-m-d', strtotime($endDate));

        $expensesFromPeriod = $this->db->query(
            "SELECT 
        c.name,
        e.date_of_expense AS date,
        e.amount,
        e.expense_comment AS comment
    FROM
        expenses AS e
        INNER JOIN expenses_category_assigned_to_users AS c ON e.expense_category_assigned_to_user_id = c.id
    WHERE
        e.date_of_expense BETWEEN :startDate AND :endDate
        AND
        e.user_id = :userId
    ORDER BY e.date_of_expense",
            [
                'startDate' => $startDate,
                'endDate' => $endDate,
                'userId' => $_SESSION['user']
            ]
        )->findAll();

        return $expensesFromPeriod;
    }

    public function countExpensesFromPeriod(string $startDate, string $endDate)
    {

        $totalExpenses = $this->db->query(
            "SELECT SUM(amount) AS amount
            FROM expenses
            WHERE user_id = :user_id
            AND date_of_expense BETWEEN :startDate AND :endDate",
            [
                'user_id' => $_SESSION['user'],
                'startDate' => $startDate,
                'endDate' => $endDate
            ]
        )->find();

        return $totalExpenses;
    }

    public function countIncomesFromPeriod(string $startDate, string $endDate)
    {

        $totalIncomes = $this->db->query(
            "SELECT SUM(amount) as amount
            FROM incomes
            WHERE user_id = :user_id
            AND date_of_income BETWEEN :startDate AND :endDate",
            [
                'user_id' => $_SESSION['user'],
                'startDate' => $startDate,
                'endDate' => $endDate
            ]
        )->find();

        return $totalIncomes;
    }

    public function countBalanceFromPeriod(string $startDate, string $endDate)
    {
        $incomes = $this->countIncomesFromPeriod($startDate, $endDate);
        $expenses = $this->countExpensesFromPeriod($startDate, $endDate);

        return $incomes['amount'] - $expenses['amount'];
    }
}
