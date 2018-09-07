<?php

namespace App\Model;

class UserModel
{
    /**
     * @var string
     *
     */
    public $username;

    /** @var string */
    public $password;

    public function toArray()
    {
        return [
            'username' => $this->username,
            'password' => $this->password,
        ];
    }
}
