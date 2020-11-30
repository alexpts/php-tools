<?php
declare(strict_types = 1);

namespace PTS\Tools;

class DeepArray
{

    protected bool $trim = false;

    public function setTrim(bool $trim = false): static
    {
        $this->trim = $trim;
        return $this;
    }

    public function getTrim(): bool
    {
        return $this->trim;
    }

    public function getAttr(array $name, array &$context, mixed $defaultValue = null): mixed
    {
        $current = array_shift($name);

        if (!array_key_exists($current, $context)) {
            return $defaultValue;
        }

        return count($name)
            ? $this->getAttr($name, $context[$current], $defaultValue)
            : $context[$current];
    }

    public function setAttr(array $name, array &$context, mixed $value): static
    {
        $current = array_shift($name);

        if (count($name) === 0) {
            $this->setValueToContext($current, $context, $value);
            return $this;
        }

        if (!array_key_exists($current, $context) || !is_array($context[$current])) {
            $context[$current] = [];
        }

        $this->setAttr($name, $context[$current], $value);

        return $this;
    }

    protected function setValueToContext(string $name, array &$context, mixed $value): void
    {
        $context[$name] = $value;

        if ($value === null && $this->trim) {
            unset($context[$name]);
        }
    }
}
