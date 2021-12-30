<?php

declare(strict_types=1);

namespace Mellanyx\Helpers;

class Utils
{
    /**
     * Склонение существительных после числительных.
     *
     * @param int  $value
     * @param array $words
     * @param bool $show
     *
     * @return string
     */
    public static function numWord(int $value, array $words, bool $show = true): string
    {
        $num = $value % 100;
        if ($num > 19) {
            $num = $num % 10;
        }

        $out = $show ? $value . ' ' : '';

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
     * @param int $bytes
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
     * @param string $link
     * @param string $text
     * @param string $title
     * @param array $extras
     *
     * @return string
     */
    public static function anchor(string $link, string $text, string $title, array $extras)
    {
        $data = '<a href="' . $link . '"';

        if ($title) {
            $data .= ' title="' . $title . '"';
        } else {
            $data .= ' title="' . $text . '"';
        }

        foreach ($extras as $rule) {
            $data .= self::parseExtras($rule);
        }

        $data .= '>';

        $data .= $text;
        $data .= "</a>";

        return $data;
    }

    /**
     * Вспомогательный метод для генератора ссылок
     *
     * @param string $rule
     *
     * @return string
     */
    public static function parseExtras(string $rule)
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

        return '';
    }
}
