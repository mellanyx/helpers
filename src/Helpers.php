<?php

namespace Mellanyx\Helpers;

class Helpers
{

    /**
     * Обёртка над функцией print_r
     *
     * @param      $array
     * @param bool $bReturn
     *
     * @return int|string
     */
    public static function p($array, bool $bReturn = false)
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
    public static function l($array)
    {
        $sResult = date('d.m.Y H:i:s') . "\n" . print_r($array, true) . "\n";
        $sResult .= "--------------------------\n";
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/l.log", $sResult,
          FILE_APPEND);
    }

    /**
     * Склонение существительных после числительных.
     *
     * @param      $value
     * @param      $words
     * @param bool $show
     *
     * @return string
     */
    public static function numWord($value, $words, bool $show = true): string
    {
        $num = $value % 100;
        if ($num > 19) {
            $num = $num % 10;
        }

        $out = ($show) ? $value . ' ' : '';
        switch ($num) {
            case 1:
                $out .= $words[0];
                break;
            case 2:
            case 3:
            case 4:
                $out .= $words[1];
                break;
            default:
                $out .= $words[2];
                break;
        }

        return $out;
    }

    /**
     * Перевод bytes to KB/MB/GB/TB
     *
     * @param $bytes
     *
     * @return string
     */
    public static function formatSize(int $bytes): string
    {
        if ($bytes < 1000 * 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }

        if ($bytes < 1000 * 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        }

        if ($bytes < 1000 * 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        }

        return number_format($bytes / 1099511627776, 2) . ' TB';
    }

    /**
     * Генератор html ссылки
     *
     * @param $link
     * @param $text
     * @param $title
     * @param $extras
     *
     * @return string
     */
    public static function anchor($link, $text, $title, $extras)
    {
        $data = '<a href="' . $link . '"';

        if ($title) {
            $data .= ' title="' . $title . '"';
        } else {
            $data .= ' title="' . $text . '"';
        }

        if (is_array($extras))//2
        {
            foreach ($extras as $rule)//3
            {
                $data .= self::parseExtras($rule);//4
            }
        }

        if (is_string($extras))//5
        {
            $data .= self::parseExtras($extras);//6
        }

        $data .= '>';

        $data .= $text;
        $data .= "</a>";

        return $data;
    }

    /**
     * Вспомогательный метод для генератора ссылок
     *
     * @param $rule
     *
     * @return string|void
     */
    public static function parseExtras($rule)
    {
        if ($rule[0] == "#") {
            $id = substr($rule, 1, strlen($rule));
            return ' id="' . $id . '"';
        }

        if ($rule[0] == ".") {
            $class = substr($rule, 1, strlen($rule));
            return ' class="' . $class . '"';
        }

        if ($rule[0] == "_") {
            return ' target="' . $rule . '"';
        }
    }

    /**
     * Определяет является ли массив ассоциативным или нет.
     *
     * #### Пример
     * ```php
     * $array = [
     *     'foo' => 'bar'
     * ];
     *
     * is_assoc( $array );
     *
     * // bool(true)
     *
     * @param array $array
     *
     * @return bool
     */
    public static function isAssoc(array $array)
    {
        if ($array === []) {
            return false;
        }

        return array_keys($array) !== range(0, count($array) - 1);
    }

    /**
     * Конвертирует массив в объект.
     *
     * #### Пример
     * ```php
     * $array = [
     *     'foo' => [
     *          'bar' => 'baz'
     *     ]
     * ];
     *
     * $obj = to_object($array);
     * echo $obj->foo->bar;
     *
     * // baz
     *
     * @param array $array
     *
     * @return object|null
     */
    public static function toObject(array $array)
    {
        $result = json_decode(json_encode($array), false);
        return is_object($result) ? $result : null;
    }

    /**
     * Возвращает первый элемент массива.
     *
     * #### Пример
     * ```php
     * $array = [
     *      'foo' => 'bar',
     *      'baz' => 'qux'
     * ];
     *
     * first( $array )
     *
     * // bar
     *
     * @param array $array
     *
     * @return mixed
     */
    public static function arrayFirst(array $array)
    {
        return $array[array_keys($array)[0]];
    }

    /**
     * Возвращает последний элемент массива.
     *
     * #### Пример
     * ```php
     * $array = [
     *      'foo' => 'bar',
     *      'baz' => 'qux'
     * ];
     *
     * last( $array )
     *
     * // qux
     *
     * @param array $array
     *
     * @return mixed
     */
    public static function arrayLast(array $array)
    {
        return $array[array_keys($array)[sizeof($array) - 1]];
    }

    /**
     * Получает значение в массиве по точечной нотации для ключей.
     *
     * #### пример
     * ```php
     * $array = [
     *      'foo' => 'bar',
     *      'baz' => [
     *          'qux => 'foobar'
     *      ]
     * ];
     *
     * array_get( 'baz.qux', $array );
     *
     * // foobar
     *
     * @param string $key
     *
     * @param array  $array
     *
     * @return mixed
     */
    public static function arrayGet(string $key, array $array)
    {
        if (is_string($key) && is_array($array)) {
            $keys = explode('.', $key);

            while (sizeof($keys) >= 1) {
                $k = array_shift($keys);

                if (!isset($array[$k])) {
                    return null;
                }

                if (sizeof($keys) === 0) {
                    return $array[$k];
                }

                $array = &$array[$k];
            }
        }

        return null;
    }

    /**
     * Устанавливает значение в массиве с использованием точечной записи.
     *
     * #### Пример 1
     *
     * $array = [
     *      'foo' => 'bar',
     *      'baz' => [
     *          'qux => 'foobar'
     *      ]
     * ];
     *
     * arraySet( 'baz.qux', 'bazqux', $array );
     *
     * // (
     * //     [foo] => bar
     * //     [baz] => [
     * //         [qux] => bazqux
     * //     ]
     * // )
     *
     *
     * #### Пример 2
     *
     * $array = [
     *      'foo' => 'bar',
     *      'baz' => [
     *          'qux => 'foobar'
     *      ]
     * ];
     *
     * arraySet( 'baz.foo', 'bar', $array );
     *
     * // (
     * //     [foo] => bar
     * //     [baz] => [
     * //         [qux] => bazqux
     * //         [foo] => bar
     * //     ]
     * // )
     *
     * @param string $key
     *
     * @param mixed  $value
     *
     * @param array  $array
     *
     * @return bool
     */
    public static function arraySet(string $key, $value, array &$array)
    {
        if (!empty($key)) {

            $keys = explode('.', $key);
            $arrTmp = &$array;

            while (sizeof($keys) >= 1) {
                $k = array_shift($keys);

                if (!is_array($arrTmp)) {
                    $arrTmp = [];
                }

                if (!isset($arrTmp[$k])) {
                    $arrTmp[$k] = [];
                }

                if (sizeof($keys) === 0) {
                    $arrTmp[$k] = $value;
                    return true;
                }

                $arrTmp = &$arrTmp[$k];
            }
        }

        return false;
    }

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
    public static function strInsert($keyValue, string $string): string
    {
        if (self::isAssoc($keyValue)) {
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
     * @param int    $limit
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

        if (sizeof($arrayWords) <= $limit) {
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
     * @param int    $limit
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
