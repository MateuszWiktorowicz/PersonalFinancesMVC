<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class StartDateSmallerThenEndDateRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        $dateOneStr = $data[$field];
        $dateTwoStr = $data[$params[0]];


        $dateOne = \DateTime::createFromFormat('Y-m-d', $dateOneStr);
        $dateTwo = \DateTime::createFromFormat('Y-m-d', $dateTwoStr);

        return $dateOne <= $dateTwo;
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "Start date must be earlier than end date.";
    }
}
