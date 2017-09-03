<?php
declare(strict_types = 1);

namespace PTS\Tools;

class DeepArray
{
    /** @var bool */
    protected $trim = false;

    /**
     * @param bool $trim
     * @return $this
     */
    public function setTrim(bool $trim = false): self
    {
        $this->trim = $trim;
        return $this;
    }

    public function getTrim(): bool
    {
        return $this->trim;
    }

    /**
     * @param array $name
     * @param array $context
     * @param mixed $defaultValue
     *
     * @return mixed
     */
    public function getAttr(array $name, array &$context, $defaultValue = false)
    {
        $current = array_shift($name);

        if (!array_key_exists($current, $context)) {
            return $defaultValue;
        }

        return count($name)
            ? $this->getAttr($name, $context[$current], $defaultValue)
            : $context[$current];
    }

    /**
     * @param array $name
     * @param array $context
     * @param mixed $value
     *
     * @return $this
     */
    public function setAttr(array $name, array &$context, $value): self
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

    protected function setValueToContext(string $name, array &$context, $value): void
    {
        $context[$name] = $value;

        if ($value === null && $this->trim) {
            unset($context[$name]);
        }
    }
}
