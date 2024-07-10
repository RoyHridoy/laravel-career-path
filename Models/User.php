<?php

namespace app\Models;

use app\core\Model;

class User extends Model
{
    public string $name            = '';
    public string $email           = '';
    public string $password        = '';
    public string $confirmPassword = '';

    public function rules(): array
    {
        return [
            'name'            => [self::RULE_REQUIRED],
            'email'           => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password'        => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 8], [self::RULE_MIN, 'min' => 2]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function register()
    {

    }
}
