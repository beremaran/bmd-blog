<?php
/**
 * Created by PhpStorm.
 * User: beremaran
 * Date: 26.09.2017
 * Time: 20:53
 */

function u_clear_str($str)
{
    /*
    $tr_ascii = [
        'ı' => 'i',
        'ü' => 'u',
        'ş' => 's',
        'ç' => 'c',
        'ğ' => 'g'
    ];
    */

    $str = strtolower($str);
    $str = str_replace(" ", "-", $str);

    return $str;
}