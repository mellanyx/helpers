<?php

declare(strict_types=1);

namespace Mellanyx\Helpers;

use Mellanyx\Helpers\Arr;

class Str
{
    /**
     * Вставляет одну или несколько строк в другую строку в определенной
     * позиции.
     *
     * #### Пример
     *
     * $keyValue = [
     *      ':color' => 'brown',
     *      ':animal' => 'dog'
     * ]
     * $string = 'The quick :color fox jumps over the lazy :animal.';
     *
     * str_insert( $keyValue, $string );
     *
     * // The quick brown fox jumps over the lazy dog.
     *
     * @param array $keyValue
     *
     * @param string $string
     *
     * @return string
     */
    public static function strInsert(array $keyValue, string $string): string
    {
        if (Arr::isAssoc($keyValue)) {
            foreach ($keyValue as $search => $replace) {
                $string = str_replace($search, $replace, $string);
            }
        }

        return $string;
    }

    /**
     * Ограничение строки по количеству слов.
     *
     * #### Пример
     *
     * $string = 'The quick brown fox jumps over the lazy dog';
     *
     * limitWords( $string, 3 );
     *
     * // The quick brown...
     *
     * @param string $string
     *
     * @param int $limit
     *
     * @param string $end
     *
     * @return string
     */
    public static function limitWords(
        string $string,
        int $limit = 10,
        string $end = '...'
    ) {
        $arrayWords = explode(' ', $string);

        if (count($arrayWords) <= $limit) {
            return $string;
        }

        return implode(' ', array_slice($arrayWords, 0, $limit)) . $end;
    }

    /**
     * Ограничение строки по количеству символов.
     *
     * #### Пример
     *
     * $string = 'The quick brown fox jumps over the lazy dog';
     *
     * limit( $string, 15 );
     *
     * // The quick brown...
     *
     * @param string $string
     *
     * @param int $limit
     *
     * @param string $end
     *
     * @return string
     */
    public static function limit(
        string $string,
        int $limit = 100,
        string $end = '...'
    ) {
        if (mb_strwidth($string, 'UTF-8') <= $limit) {
            return $string;
        }

        return rtrim(mb_strimwidth($string, 0, $limit, '', 'UTF-8')) . $end;
    }
}
