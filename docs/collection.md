### Collection
Коллекция с приоритетом

Позволяет хранить любые сущности в виде именной коллекции с приоритетом.

Коллекция напоминает сортированный список. Вы добавляете в списко любой объект $item с указанием приоритета.
```php
addItem(string $name, mixed $item, int $priority = 50)
```

Вы можете получить весь список с сохранением группы приоритета. Дополнительно можно отсортировать по приоритету.
```php
getItems(bool $sort = true)
```

Вы можете получить список в виде 1 уровнего массива, без группы приоритета. Дополнительно можно отсортировать по приоритету.
```php
getFlatItems(bool $sort = true)
```