<?php
namespace App\Auth;

use Cake\Auth\AbstractPasswordHasher;

class LegacyPasswordHasher extends AbstractPasswordHasher
{
    protected $_defaultConfig = [
        'hashType' => PASSWORD_DEFAULT,
        'hashOptions' => []
    ];

    public function hash($password)
    {
        return password_hash(
            $password,
            $this->_config['hashType'],
            $this->_config['hashOptions']
        );
    }

    public function check($password, $hashedPassword)
    {
        return $password === $hashedPassword;
    }
}

