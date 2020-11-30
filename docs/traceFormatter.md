### TraceFormatter

Преобразует массив трейсов в компактный формат для логов, позволяет вырезать префикс из трейсов для усменьшения размеров

```php
use PTS\Tools\TraceFormatter;

$projectDir = dirname(__DIR__, 2);
$formatter = new TraceFormatter($projectDir);
$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
$compactTrace = $formatter->formatTrace($trace);
```
