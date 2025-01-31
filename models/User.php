<?php

namespace app\models;

use app\core\DbModel;

class User extends DbModel
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 2;


    // initilize the variables to empty strings (to avoid undefined variable error)
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $passwordRepeat = '';
    public int $status = self::STATUS_INACTIVE;

    public function save()
    {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);        
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 24]],
            'passwordRepeat' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function tableName(): string
    {
        return "users";
    }

    public function attributes(): array
    {
        return ['name', 'email', 'password', 'status'];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function labels(): array
    {
        return [
            'name' => 'Your name',
            'email' => 'Email',
            'password' => 'Password',
            'passwordRepeat' => 'Repeat Password',
        ];
    }
}