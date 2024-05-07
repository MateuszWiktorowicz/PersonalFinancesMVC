<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{
    RequiredRule,
    EmailRule,
    MinRule,
    InRule,
    UrlRule,
    MatchRule,
    LengthMaxRule,
    NumericRule,
    DateFormatRule
};

class ValidatorService
{
    private Validator $validator;
    public function __construct()
    {
        $this->validator = new Validator();

        $this->validator->addRule('required', new RequiredRule());
        $this->validator->addRule('email', new EmailRule());
        $this->validator->addRule('min', new MinRule());
        $this->validator->addRule('in', new InRule());
        $this->validator->addRule('url', new UrlRule());
        $this->validator->addRule('match', new MatchRule());
        $this->validator->addRule('maxLength', new LengthMaxRule());
        $this->validator->addRule('numeric', new NumericRule());
        $this->validator->addRule('dateFormat', new DateFormatRule());
    }

    public function validateRegister(array $dataForm)
    {
        $this->validator->validate($dataForm, [
            'email' => ['required', 'email'],
            'password' => ['required'],
            'confirmPassword' => ['required', 'match:password'],
        ]);
    }

    public function validateLogin(array $dataForm)
    {
        $this->validator->validate($dataForm, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
    }

    public function validateTranstaction(array $dataForm)
    {
        $this->validator->validate($dataForm, [
            'description' => ['required', 'maxLength:255'],
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'dateFormat:Y-m-d']
        ]);
    }
}
