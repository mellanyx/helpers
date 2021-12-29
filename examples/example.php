<?php

require __DIR__ . '/../vendor/autoload.php';

use Mellanyx\Helpers\Helpers;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];

Helpers::p($arr);


//Helpers::l($arr);


Helpers::p(Helpers::numWord(5, ['товар', 'товара', 'товаров']));


Helpers::p(Helpers::numWord(5, ['товар', 'товара', 'товаров'], false));

Helpers::p(Helpers::formatSize(1024));

$extras = ['#test_id','.test_class','_blank'];
Helpers::p(Helpers::anchor('https://google.com', 'Проверка связи', 'Это Title', $extras));

Helpers::p(Helpers::isAssoc($arr));

Helpers::p(Helpers::toObject($arr));


Helpers::p(Helpers::arrayFirst($arr));


Helpers::p(231312);
Helpers::p(Helpers::arrayLast($arr));


Helpers::p(Helpers::arrayGet('bar.aaa', $arr));


Helpers::p(Helpers::arraySet('bar.zzz', 'added from func', $arr));
Helpers::p($arr);


$keyValue = [
    ':color' => 'brown',
    ':animal' => 'dog'
];
$string = 'The quick :color fox jumps over the lazy :animal.';
Helpers::p($string);
Helpers::p(Helpers::strInsert($keyValue, $string));
