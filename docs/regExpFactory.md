### RegExpFactory

Позволяет создавать функции-регулярные выражения с карированем параметров

```php
$factory = new \PTS\Tools\RegExpFactory;
$regExp = $factory->create('~[^\d+]~', '');
$regExp('+7(123) 213-1231') // '71232131231'
```
