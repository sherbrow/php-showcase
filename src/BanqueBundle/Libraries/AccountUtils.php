<?php

namespace BanqueBundle\Libraries;

class AccountUtils
{
    
    /**
     * @returns a string following the pattern "XX99"
     */
    public static function generateAccountNumber() {
        $letters = chr(rand(65, 90)).chr(rand(65, 90));
        $number = rand(10,99);
        return $letters.$number;
    }

}
