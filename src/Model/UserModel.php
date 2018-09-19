<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class UserModel
{
    /**
     * @var username
     * @Assert\NotNull(message ="Veuilliez renseigner votre nom d'utilisateur !!")
     * @Assert\Length(max="10", maxMessage="Max de caractère  10")
     */
    public $username;

    /**
     * @Assert\NotNull(message ="Veuilliez renseigner votre mot de passe !!")
     */
    public $password;
}
