<!-- markdownlint-configure-file {
  "MD013": {
    "code_blocks": false,
    "tables": false
  },
  "MD033": false,
  "MD041": false
} -->

<div align="center">

## Полезные вспомогательные функции для php разработчика

[![PHP-CI](https://github.com/mellanyx/helpers/workflows/PHP-CI/badge.svg?branch=dev)](https://github.com/mellanyx/helpers/actions)
[![Source Code](https://img.shields.io/badge/source-mellanyx%2Fhelpers-blue)](https://github.com/mellanyx/helpers)
[![GitHub tag (latest SemVer)](https://img.shields.io/github/v/tag/mellanyx/helpers?label=stable)](https://github.com/mellanyx/helpers/releases)
[![Packagist](https://img.shields.io/packagist/dt/mellanyx/helpers)](https://packagist.org/packages/mellanyx/helpers)


</div>


#### Установка
```bash
composer require mellanyx/helpers
```


#### Обёртка над функцией print_r - p()
```php
<?php
use Mellanyx\Helpers\Utils;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];

Utils::p($arr);

Результат:
<pre>
Array
(
    [0] => 'one'
    [1] => 'two'
    ['bar'] => [
        ['aaa'] => 'str_aaa'
        ['bbb'] => 'str_bbb'
    ]

)
</pre>
```

#### Записывает массив в файл - l()
```php
<?php
use Mellanyx\Helpers\Arr;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];

Arr::l($arr);
```

#### Склонение существительных после числительных - numWord()
```php
<?php
use Mellanyx\Helpers\Utils;

Utils::numWord(5, ['товар', 'товара', 'товаров']);

Результат: 5 товаров

Utils::numWord(5, ['товар', 'товара', 'товаров'], false);

Результат: товаров
```

#### Перевод bytes to KB/MB/GB/TB - numWord() 
```php
<?php
use Mellanyx\Helpers\Utils;

Utils::formatSize(1024);

Результат: 1.00 KB
```

#### Генератор html ссылки - anchor()
```php
<?php
use Mellanyx\Helpers\Utils;

$extras = ['#test_id','.test_class','_blank'];
Utils::anchor('https://google.com', 'Проверка связи', 'Это Title', $extras);

Результат: <a href="https://google.com" title="Это Title" id="test_id" class="test_class" target="_blank">Проверка связи</a>
```

#### Проверка массива на ассоциативность - isAssoc()
```php
<?php
use Mellanyx\Helpers\Arr;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];
Arr::isAssoc($arr);

Результат: 1
```

#### Конвертирует массив в объект - toObject()
```php
<?php
use Mellanyx\Helpers\Arr;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];
Arr::toObject($arr);

Результат:
stdClass Object
(
    [0] => one
    [1] => two
    [bar] => stdClass Object
        (
            [aaa] => str_aaa
            [bbb] => str_bbb
        )

)

```

#### Возвращает первый элемент массива - arrayFirst()
```php
<?php
use Mellanyx\Helpers\Arr;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];
Arr::arrayFirst($arr);

Результат: one
```

#### Возвращает последний элемент массива - arrayLast()
```php
<?php
use Mellanyx\Helpers\Arr;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];
Arr::arrayLast($arr);

Результат:
Array
(
    [aaa] => str_aaa
    [bbb] => str_bbb
)
```

#### Получает значение в массиве по точечной нотации для ключей - arrayGet()
```php
<?php
use Mellanyx\Helpers\Arr;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];
Arr::arrayGet('bar.aaa', $arr);

Результат: str_aaa
```

#### Устанавливает значение в массиве с использованием точечной записи - arraySet()
```php
<?php
use Mellanyx\Helpers\Arr;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];
Arr::arraySet('bar.zzz', 'added from func', $arr)

Результат:
Array
(
    [0] => one
    [1] => two
    [bar] => Array
        (
            [aaa] => str_aaa
            [bbb] => str_bbb
            [zzz] => added from func
        )

)
```

#### Вставляет одну или несколько строк в другую строку в определенной позиции - strInsert()
```php
<?php
use Mellanyx\Helpers\Str;

$keyValue = [
    ':color' => 'brown',
    ':animal' => 'dog'
];

$string = 'The quick :color fox jumps over the lazy :animal.';

Str::strInsert($keyValue, $string);

Результат: The quick brown fox jumps over the lazy dog.
```

#### Ограничение строки по количеству слов - limitWords()
```php
<?php
use Mellanyx\Helpers\Str;

$string = 'The quick brown fox jumps over the lazy dog';

Str::limitWords($string, 3);

Результат: The quick brown...
```

#### Ограничение строки по количеству символов - limit()
```php
<?php
use Mellanyx\Helpers\Str;

$string = 'The quick brown fox jumps over the lazy dog';

Str::limit($string, 15);

Результат: The quick brown...
```

## License

Данная `mellanyx/helpers` библиотека лицензирована для использования в рамках MIT License (MIT).  
Пожалуйста прочитайте [LICENSE](https://github.com/mellanyx/helpers/blob/dev/LICENSE) для большей информации.
