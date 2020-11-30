### RegExpFactory

Позволяет создавать функции-регулярные выражения с карированем параметров

```php
use PTS\Tools\RegExpFactory;

$factory = new RegExpFactory;
$regExp = $factory->create('~[^\d+]~', '');
$regExp('+7(123) 213-1231'); // '71232131231'
```
