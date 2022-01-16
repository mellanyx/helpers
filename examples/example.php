<?php

require __DIR__ . '/../vendor/autoload.php';

use Mellanyx\Helpers\Arr;
use Mellanyx\Helpers\Str;
use Mellanyx\Helpers\Utils;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];

p($arr);


//Arr::l($arr);


p(Utils::numWord(11, ['товар', 'товара', 'товаров']));


p(Utils::numWord(5, ['товар', 'товара', 'товаров'], false));

p(Utils::formatSize(1024));

$extras = ['#test_id', '.test_class', '_blank'];
p(Utils::anchor('https://google.com', 'Проверка связи', 'Это Title', $extras));

p(Arr::isAssoc($arr));

p(Arr::toObject($arr));


p(Arr::arrayFirst($arr));


p(Arr::arrayLast($arr));


p(Arr::arrayGet('bar.aaa', $arr));


p(Arr::arraySet('bar.zzz', 'added from func', $arr));
p($arr);


$keyValue = [
    ':color'  => 'brown',
    ':animal' => 'dog',
];
$string = 'The quick :color fox jumps over the lazy :animal.';
p($string);
p(Str::strInsert($keyValue, $string));

//dd(array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43"));
