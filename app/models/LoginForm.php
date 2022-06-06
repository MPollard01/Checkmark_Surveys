<?php

namespace App\Models;
use App\Classes\Session;

class LoginForm extends Model
{
    public string $username = '';
    public string $password = '';

    public function rules()
    {
        return [
            'username' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
        ];
    }


    public function login()
    {
        $user = User::get($this->username);
        if (!$user) {
            $this->addError('username', 'Username does not exist');
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }

        Session::add('username', $this->username);

        return true;
    }
}