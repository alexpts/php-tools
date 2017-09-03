### DeepAttr

Позволяет считывать и записывать вложенные свойства массива.

Коллекция напоминает сортированный список. Вы добавляете в списко любой объект $item с указанием приоритета.
```php
$service = new \PTS\Tools\DeepAttr;

$source = ['user' => ['age' => 12, 'name' => 'Alex']];
$service->setAttr[['user', 'age'], $source, 16];
$age = $service->getAttr[['user', 'age'], $source];
```
