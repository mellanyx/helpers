<?php

require __DIR__ . '/../vendor/autoload.php';

use Mellanyx\Helpers\Arr;
use Mellanyx\Helpers\Str;
use Mellanyx\Helpers\Utils;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];

Utils::p($arr);


//Arr::l($arr);


Utils::p(Utils::numWord(5, ['товар', 'товара', 'товаров']));


Utils::p(Utils::numWord(5, ['товар', 'товара', 'товаров'], false));

Utils::p(Utils::formatSize(1024));

$extras = ['#test_id','.test_class','_blank'];
Utils::p(Utils::anchor('https://google.com', 'Проверка связи', 'Это Title', $extras));

Utils::p(Arr::isAssoc($arr));

Utils::p(Arr::toObject($arr));


Utils::p(Arr::arrayFirst($arr));


Utils::p(Arr::arrayLast($arr));


Utils::p(Arr::arrayGet('bar.aaa', $arr));


Utils::p(Arr::arraySet('bar.zzz', 'added from func', $arr));
Utils::p($arr);


$keyValue = [
    ':color' => 'brown',
    ':animal' => 'dog'
];
$string = 'The quick :color fox jumps over the lazy :animal.';
Utils::p($string);
Utils::p(Str::strInsert($keyValue, $string));
