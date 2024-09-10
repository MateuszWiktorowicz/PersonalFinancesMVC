<?php

declare(strict_types=1);

use Framework\Http;

function dump(mixed $value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function escapeData(mixed $value): string
{
    return htmlspecialchars((string) $value);
}

function redirectTo(string $path)
{
    header("Location: {$path}");
    http_response_code(Http::REDIRECT_STATUS_CODE);
    exit;
}

function getCurrentMonthDates()
{
    $firstDayOfMonth = date('Y-m-01');
    $lastDayOfMonth = date('Y-m-t', strtotime($firstDayOfMonth));

    return [
        'startDate' => "{$firstDayOfMonth}",
        'endDate' => "{$lastDayOfMonth}"
    ];
}

function getLastMonthDates()
{
    $currentYear = date('Y');
    $currentMonth = date('m');

    $previousMonth = ($currentMonth == 1) ? 12 : $currentMonth - 1;
    $previousYear = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;

    $firstDayOfLastMonth = date('Y-m-01', strtotime("$previousYear-$previousMonth-01"));

    $lastDayOfLastMonth = date('Y-m-t', strtotime($firstDayOfLastMonth));

    return [
        'startDate' => "{$firstDayOfLastMonth}",
        'endDate' => "{$lastDayOfLastMonth}"
    ];
}

function getCurrentYearDates()
{
    $currentYear = date('Y');

    return [
        'startDate' => "{$currentYear}-01-01",
        'endDate' => "{$currentYear}-12-31"
    ];
}

function getPeriodDates(mixed $period = 'currentMonth')
{
    $dates = [];
    switch ($period) {
        case 'currentMonth':
            $dates = getCurrentMonthDates();
            break;
        case 'lastMonth':
            $dates = getLastMonthDates();
            break;
        case 'currentYear':
            $dates = getCurrentYearDates();
            break;
    }


    return $dates;
}

function getFirstAndLastDayOfMonthFromDate($date)
{

    $year = date('Y', strtotime($date));
    $month = date('m', strtotime($date));


    $firstDay = "{$year}-{$month}-01";


    $lastDay = date('Y-m-t', strtotime($firstDay));

    return [
        'firstDay' => $firstDay,
        'lastDay' => $lastDay
    ];
}
