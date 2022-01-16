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

/**
 * Запись массива в файл
 *
 * @param array | object $in
 *
 * @param bool $opened
 *
 * @param int $margin
 *
 * @return void
 */
function dd($in, bool $opened = false, int $margin = 10): void
{
    if (! is_object($in) && ! is_array($in)) {
        return;
    }

    foreach ($in as $key => $value) {
        if (is_object($value) or is_array($value)) {
            echo '<details style="margin-left:' . $margin . 'px; padding:5px;" ' . $opened . '>';
            echo '<summary>';
            echo is_object($value) ? $key . ' {' . count((array) $value) . '} (' . gettype($value) . ')' : $key . ' [' . count($value) . '] (' . gettype($value) . ')';
            echo '</summary>';
            dd($value, $opened, $margin + 10);
            echo '</details>';
        } else {
            switch (gettype($value)) {
                case 'string':
                    $bgc = 'red';
                    break;
                case 'integer':
                    $bgc = 'green';
                    break;
                default:
                    $bgc = 'white';
                    break;
            }
            echo '<div style="margin-left:' . $margin . 'px">' . $key . ' : <span style="color:' . $bgc . '">' . $value . '</span> (' . gettype($value) . ')</div>';
        }
    }

    exit();
}
