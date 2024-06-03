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
            expenses.id AS id,
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
            incomes.id AS id,
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

    public function getUserTransactionsFromPeriod(string $startDate, string $endDate)
    {
        $transactions = $this->db->query(
            "SELECT 
            expenses.id AS id,
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
            AND 
            expenses.date_of_expense BETWEEN :start_date AND :end_date
        UNION ALL
        SELECT 
            incomes.id AS id,
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
            AND 
            incomes.date_of_income BETWEEN :start_date AND :end_date
            ORDER BY date DESC",
            [
                'user_id' => $_SESSION['user'],
                'start_date' => $startDate,
                'end_date' => $endDate
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

    public function getExpensesBalanceByCategoryNameFromPeriod(string $startDate, string $endDate)
    {
        $categoryBalance = $this->db->query(
            "SELECT 
            c.name AS 'name',
            SUM(e.amount) AS 'value'
        FROM 
            expenses as e
            INNER JOIN expenses_category_assigned_to_users as c ON c.id = e.expense_category_assigned_to_user_id
        WHERE 
            e.user_id = :user_id
            AND
            date_of_expense BETWEEN :start_date AND :end_date
        GROUP BY 
            e.expense_category_assigned_to_user_id
        ORDER BY 
            SUM(e.amount) DESC",
            [
                'user_id' => $_SESSION['user'],
                'start_date' => $startDate,
                'end_date' => $endDate
            ]
        )->findAll();

        return $categoryBalance;
    }

    public function getIncomesBalanceByCategoryNameFromPeriod(string $startDate, string $endDate)
    {
        $categoryBalance = $this->db->query(
            "SELECT 
            c.name AS 'name', 
            SUM(i.amount) AS 'value'
        FROM 
            incomes as i
            INNER JOIN incomes_category_assigned_to_users as c ON c.id = i.income_category_assigned_to_user_id
        WHERE 
            i.user_id = :user_id
            AND
            date_of_income BETWEEN :start_date AND :end_date
        GROUP BY 
            i.income_category_assigned_to_user_id
        ORDER BY 
            SUM(i.amount) DESC",
            [
                'user_id' => $_SESSION['user'],
                'start_date' => $startDate,
                'end_date' => $endDate
            ]
        )->findAll();

        return $categoryBalance;
    }


    public function getUserTransaction(string $id, string $type)
    {
        if ($type === 'Income') {
            return $this->db->query(
                "SELECT *, income_comment AS comment, 'Income' AS type, DATE_FORMAT(date_of_income, '%Y-%m-%d') as formatted_date 
                FROM incomes
            WHERE id = :id AND user_id = :user_id",
                [
                    'id' => $id,
                    'user_id' => $_SESSION['user']
                ]
            )->find();
        } elseif ($type === 'Expense') {
            return $this->db->query(
                "SELECT *, expense_comment AS comment, 'Expense' AS type, DATE_FORMAT(date_of_expense, '%Y-%m-%d') as formatted_date 
                FROM expenses
            WHERE id = :id AND user_id = :user_id",
                [
                    'id' => $id,
                    'user_id' => $_SESSION['user']
                ]
            )->find();
        }
    }

    public function updateIncome(array $formData, int $id)
    {
        $formattedDate = "{$formData['date']} 00:00:00";

        $this->db->query(
            "UPDATE incomes
            SET income_category_assigned_to_user_id = :category,
                amount = :amount,
                date_of_income = :date,
                income_comment = :comment
            WHERE id = :id
            AND user_id = :user_id",
            [
                'comment' => $formData['description'],
                'amount' => $formData['amount'],
                'date' => $formattedDate,
                'category' => $formData['category'],
                'id' => $id,
                'user_id' => $_SESSION['user']
            ]
        );
    }

    public function updateExpense(array $formData, int $id)
    {
        $formattedDate = "{$formData['date']} 00:00:00";

        $this->db->query(
            "UPDATE expenses
            SET expense_category_assigned_to_user_id = :category,
                payment_method_assigned_to_user_id = :method,
                amount = :amount,
                date_of_expense = :date,
                expense_comment = :comment
            WHERE id = :id
            AND user_id = :user_id",
            [
                'comment' => $formData['description'],
                'amount' => $formData['amount'],
                'date' => $formattedDate,
                'method' => $formData['paymentMethod'],
                'category' => $formData['category'],
                'id' => $id,
                'user_id' => $_SESSION['user']
            ]
        );
    }

    public function delete(int $id, string $type)
    {
        if ($type === "Income") {
            $this->db->query(
                "DELETE FROM incomes WHERE id = :id AND user_id = :user_id",
                [
                    'id' => $id,
                    'user_id' => $_SESSION['user']
                ]
            );
        } elseif ($type === "Expense") {
            $this->db->query(
                "DELETE FROM expenses WHERE id = :id AND user_id = :user_id",
                [
                    'id' => $id,
                    'user_id' => $_SESSION['user']
                ]
            );
        }
    }

    public function selectIncomesByCategory(int $categoryId)
    {
        return $this->db->query(
            " SELECT 
            incomes.id AS id,
            incomes.amount AS amount,
            ic.name AS category,
            '-' AS paymentMethod,
            incomes.date_of_income AS date,
            incomes.income_comment AS comment,
            'Income' AS type
        FROM 
            incomes
            INNER JOIN incomes_category_assigned_to_users AS ic ON ic.id = incomes.income_category_assigned_to_user_id 
            WHERE income_category_assigned_to_user_id = :id AND incomes.user_id = :user_id",
            [
                'id' => $categoryId,
                'user_id' => $_SESSION['user']
            ]
        )->findAll();
    }

    public function selectExpensesByCategory(int $categoryId)
    {
        return $this->db->query(
            " SELECT 
            expenses.id AS id,
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
            WHERE expense_category_assigned_to_user_id = :id AND expenses.user_id = :user_id
            ",
            [
                'id' => $categoryId,
                'user_id' => $_SESSION['user']
            ]
        )->findAll();
    }

    public function countIncomesByCategory(int $categoryId)
    {
        return $this->db->query(
            "SELECT COUNT(*) FROM incomes WHERE income_category_assigned_to_user_id = :id AND user_id = :user_id",
            [
                'id' => $categoryId,
                'user_id' => $_SESSION['user']
            ]
        )->count();
    }

    public function countExpensesByCategory(int $categoryId)
    {
        return $this->db->query(
            "SELECT COUNT(*) FROM expenses WHERE expense_category_assigned_to_user_id = :id AND user_id = :user_id",
            [
                'id' => $categoryId,
                'user_id' => $_SESSION['user']
            ]
        )->count();
    }


    public function countExpensesByPaymentMethod(int $methodId)
    {
        return $this->db->query(
            "SELECT COUNT(*) FROM expenses WHERE payment_method_assigned_to_user_id = :id AND user_id = :user_id",
            [
                'id' => $methodId,
                'user_id' => $_SESSION['user']
            ]
        )->count();
    }

    public function selectExpensesByPaymentMethods(int $categoryId)
    {
        return $this->db->query(
            " SELECT 
            expenses.id AS id,
            expenses.amount AS amount,
            pm.name AS category,
            pm.name AS paymentMethod,
            expenses.date_of_expense AS date,
            expenses.expense_comment AS comment,
            'Expense' AS type
        FROM 
        expenses
            INNER JOIN payment_methods_assigned_to_users AS pm ON pm.id = expenses.payment_method_assigned_to_user_id 
            WHERE payment_method_assigned_to_user_id = :id AND expenses.user_id = :user_id",
            [
                'id' => $categoryId,
                'user_id' => $_SESSION['user']
            ]
        )->findAll();
    }
}
