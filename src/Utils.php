<?php

namespace Mellanyx\Helpers;

class Utils
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

}
