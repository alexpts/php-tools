### ArrayHelper

Содержит набор методов для работу с массивами


#### partition

Позволяет разделить массив на части через функции обрабного вызова

```php
$helper = new \PTS\Tools\ArrayHelper;
$data = [1, 3, 5, 20, 45, 56, 78, 203];
[$part1, $part2] = $helper->partition($data, function($item, $index, $collection) {
	return $item < 50;
});

$part1; // [1, 3, 5, 20, 45];
$part2; // [56, 78, 203];
```

```php
$helper = new \PTS\Tools\ArrayHelper;
$data = [1, 3, 5, 20, 45, 56, 78, 203];
[$part1, $part2, $other] = $helper->partition(
	$data,
	function($item, $index, $collection) {
		return $item < 50;
	},
	function($item, $index, $collection) {
		return $item < 100;
	},
);

$part1; // [1, 3, 5, 20, 45];
$part2; // [56, 78];
$other; // [203];
```
