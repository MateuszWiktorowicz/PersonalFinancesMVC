<?php

declare(strict_types=1);

namespace Framework;

use Framework\Contracts\RuleInterface;
use Framework\Exceptions\ValidationException;

class Validator
{
    private array $rules = [];

    public function addRule(string $alias, RuleInterface $rule)
    {
        $this->rules[$alias] = $rule;
    }

    public function validate(array $dataForm, array $fields)
    {
        $errors = [];

        foreach ($fields as $fieldName => $rules) {
            foreach ($rules as $rule) {
                $ruleParams = [];

                if (str_contains($rule, ':')) {
                    [$rule, $ruleParams] = explode(':', $rule);
                    $ruleParams = explode(',', $ruleParams);
                }

                $ruleValidator = $this->rules[$rule];

                if ($ruleValidator->validate($dataForm, $fieldName, $ruleParams)) {
                    continue;
                }

                $errors[$fieldName][] = $ruleValidator->getMessage(
                    $dataForm,
                    $fieldName,
                    $ruleParams
                );
            }
        }

        if (count($errors)) {
            throw new ValidationException($errors);
        }
    }
}
