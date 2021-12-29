<?php
/**
 * Created by PhpStorm.
 * User: b2black
 * Date: 29.12.2021.12.2021
 * Time: 17:49
 */

namespace Mellanyx\Helpers;


class Bogdan
{
    /**
     * This method says something in bogdanovski
     */
    public static function saySomething(): void
    {
        $values = [
            'Netcat huita',
            'Bitrix huita',
            'Cherniy fon, cvetnie bukvi',
            'Eto ne ja delal'
        ];
        echo $values[array_rand($values)];
    }
}
