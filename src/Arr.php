<?php

declare(strict_types=1);

namespace Mellanyx\Helpers;

class Arr
{
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
        return $array[array_keys($array)[count($array) - 1]];
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
     * @param array $array
     *
     * @return mixed
     */
    public static function arrayGet(string $key, array $array)
    {
        $keys = explode('.', $key);

        while (count($keys) >= 1) {
            $k = array_shift($keys);

            if (! isset($array[$k])) {
                return null;
            }

            if (count($keys) === 0) {
                return $array[$k];
            }

            $array = &$array[$k];
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
     * @param mixed $value
     *
     * @param array $array
     *
     * @return bool
     */
    public static function arraySet(string $key, $value, array &$array)
    {
        if (! empty($key)) {
            $keys = explode('.', $key);
            $arrTmp = &$array;

            while (count($keys) >= 1) {
                $k = array_shift($keys);

                if (! is_array($arrTmp)) {
                    $arrTmp = [];
                }

                if (! isset($arrTmp[$k])) {
                    $arrTmp[$k] = [];
                }

                if (count($keys) === 0) {
                    $arrTmp[$k] = $value;
                    return true;
                }

                $arrTmp = &$arrTmp[$k];
            }
        }

        return false;
    }
}
