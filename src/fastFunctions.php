<?php

declare(strict_types=1);

// Быстрый вызов функций без namespace //

/**
 * Обёртка над функцией print_r
 *
 * @param string | array | int | bool | object $array
 * @param bool $bReturn
 *
 * @return int|string
 */
function p($array, bool $bReturn = false)
{
    $sResult = "<pre>" . print_r($array, true) . "</pre>\n";
    if ($bReturn) {
        return $sResult;
    } else {
        echo $sResult;
        return 0;
    }
}

/**
 * Запись массива в файл
 *
 * @param $array
 *
 * @return void
 */
function l(string $path, array $array)
{
    $sResult = date('d.m.Y H:i:s') . "\n" . print_r($array, true) . "\n";
    $sResult .= "--------------------------\n";
    file_put_contents(
        $path . "/l.log",
        $sResult,
        FILE_APPEND
    );
}
