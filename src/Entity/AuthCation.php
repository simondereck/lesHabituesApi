<?php


namespace App\Entity;


use App\Tools\SMTools;

class AuthCation
{

    public $error;

    /**
     * @return string
     * this method is hash with md5 salt
     * is more security
     */
    public function generatePassword():string
    {
        return md5(md5($this->getPassword()).SMTools::$salt);
    }


}