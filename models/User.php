<?php

namespace app\models;

use app\core\DbModel;
use app\core\Model;

class RegisterModel extends DbModel
{
    // initilize the variables to empty strings (to avoid undefined variable error)
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $passwordRepeat = '';

    public function register()
    {
        return 'Creating new user';
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 24]],
            'passwordRepeat' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }
}