<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class AccountService
{
    public function __construct(private Database $db)
    {
    }

    public function getIncomesFromPeriod(string $startDate, string $endDate)
    {
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
            ]
        )->findAll();

        return $incomesFromPeriod;
    }
}
