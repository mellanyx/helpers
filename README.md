<!-- markdownlint-configure-file {
  "MD013": {
    "code_blocks": false,
    "tables": false
  },
  "MD033": false,
  "MD041": false
} -->

<div align="center">

# Полезные вспомогательные функции для php разработчика

</div>


#### Установка
```bash
composer require clausnz/php-helpers
```


#### Обёртка над функцией print_r - p()
```php
<?php
use Mellanyx\Helpers\Helpers;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];

Helpers::p($arr);

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
use Mellanyx\Helpers\Helpers;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];

Helpers::l($arr);
```

#### Склонение существительных после числительных - numWord()
```php
<?php
use Mellanyx\Helpers\Helpers;

Helpers::numWord(5, ['товар', 'товара', 'товаров']);

Результат: 5 товаров

Helpers::numWord(5, ['товар', 'товара', 'товаров'], false);

Результат: товаров
```

#### Перевод bytes to KB/MB/GB/TB - numWord() 
```php
<?php
use Mellanyx\Helpers\Helpers;

Helpers::formatSize(5, ['товар', 'товара', 'товаров']);

Результат: 1.00 KB
```

#### Генератор html ссылки - anchor()
```php
<?php
use Mellanyx\Helpers\Helpers;

$extras = ['#test_id','.test_class','_blank'];
Helpers::anchor('https://google.com', 'Проверка связи', 'Это Title', $extras);

Результат: <a href="https://google.com" title="Это Title" id="test_id" class="test_class" target="_blank">Проверка связи</a>
```

#### Проверка массива на ассоциативность - isAssoc()
```php
<?php
use Mellanyx\Helpers\Helpers;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];
Helpers::isAssoc($arr);

Результат: 1
```

#### Конвертирует массив в объект - toObject()
```php
<?php
use Mellanyx\Helpers\Helpers;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];
Helpers::toObject($arr);

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
use Mellanyx\Helpers\Helpers;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];
Helpers::arrayFirst($arr);

Результат: one
```

#### Возвращает последний элемент массива - arrayLast()
```php
<?php
use Mellanyx\Helpers\Helpers;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];
Helpers::arrayLast($arr);

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
use Mellanyx\Helpers\Helpers;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];
Helpers::arrayGet('bar.aaa', $arr);

Результат: str_aaa
```

#### Устанавливает значение в массиве с использованием точечной записи - arraySet()
```php
<?php
use Mellanyx\Helpers\Helpers;

$arr = ['one', 'two', 'bar' => ['aaa' => 'str_aaa', 'bbb' => 'str_bbb']];
Helpers::arraySet('bar.zzz', 'added from func', $arr)

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
use Mellanyx\Helpers\Helpers;

$keyValue = [
    ':color' => 'brown',
    ':animal' => 'dog'
];

$string = 'The quick :color fox jumps over the lazy :animal.';

Helpers::strInsert($keyValue, $string);

Результат: The quick brown fox jumps over the lazy dog.
```

#### Ограничение строки по количеству слов - limitWords()
```php
<?php
use Mellanyx\Helpers\Helpers;

$string = 'The quick brown fox jumps over the lazy dog';

Helpers::limitWords($string, 3);

Результат: The quick brown...
```

#### Ограничение строки по количеству символов - limit()
```php
<?php
use Mellanyx\Helpers\Helpers;

$string = 'The quick brown fox jumps over the lazy dog';

Helpers::limit($string, 15);

Результат: The quick brown...
```
